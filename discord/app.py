# Before you can use that, you need to install discord.py mysql-connector-python aiohttp pytz

import discord
from discord import app_commands
from discord.ext import tasks
import random
import string
import mysql.connector
from datetime import datetime
import re
import math

intents = discord.Intents.all()
intents.messages = True
client = discord.Client(intents=intents)
tree = app_commands.CommandTree(client)

DATABASE_CONFIG = {
    "host": "Your DB Host",
    "port": 3306,
    "user": "licenses",
    "password": "YOUR PASSWORD HERE",
    "database": "licenses"
}

TOKEN = "YOUR BOT TOKEN"

ROLE_ID = 1252234845426552972

def get_db_connection():
    return mysql.connector.connect(
        host=DATABASE_CONFIG["host"],
        port=DATABASE_CONFIG["port"],
        user=DATABASE_CONFIG["user"],
        password=DATABASE_CONFIG["password"],
        database=DATABASE_CONFIG["database"]
    )

def generate_license_key():
    parts = [''.join(random.choices(string.ascii_uppercase + string.digits, k=4)) for _ in range(3)]
    return '-'.join(parts)

def validate_ip(ip):
    return bool(re.match(r"^(?:\d{1,3}\.){3}\d{1,3}$|^\*$", ip))

def validate_port(port):
    return port == '*' or (port.isdigit() and 1 <= int(port) <= 65535)

def create_embed(title, description=None, fields=None):
    embed = discord.Embed(title=title, description=description, color=0x00ff00)
    if fields:
        for name, value, inline in fields:
            embed.add_field(name=name, value=value, inline=inline)
    embed.set_footer(text='© 2024 Zenaria')
    return embed

@tree.command(
    name="license_create",
    description="Create a new license key with specified details."
)
@app_commands.describe(
    expire_date="Expiration Date (YYYY-MM-DD).", owner="Owner Name.",
    discord_username="Discord Username.", product="Product Name.", allowed_ips="Comma-separated IPs.",
    allowed_ports="Comma-separated Ports."
)
async def license_create(interaction: discord.Interaction, expire_date: str, owner: str, discord_username: str, product: str, allowed_ips: str, allowed_ports: str):
    if discord.utils.get(interaction.user.roles, id=ROLE_ID) is None:
        await interaction.response.send_message("`🚫` You don't have the required role to use this command.", ephemeral=True)
        return

    ips = allowed_ips.split(',')
    ports = allowed_ports.split(',')

    if not all(validate_ip(ip) for ip in ips) or not all(validate_port(port) for port in ports):
        await interaction.response.send_message("`🚫` Invalid IP or Port format.", ephemeral=True)
        return

    license_key = generate_license_key()
    created_at = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    try:
        db = get_db_connection()
        cursor = db.cursor()

        sql = """INSERT INTO licenses
                 (`key`, expire_date, owner, discord, product, allowed_ips, allowed_ports, creation_date)
                 VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"""
        val = (license_key, expire_date, owner, discord_username, product, allowed_ips, allowed_ports, created_at)
        cursor.execute(sql, val)
        db.commit()
        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        await interaction.response.send_message(f"`🚫` Error: {err}", ephemeral=True)
        return

    embed = create_embed(
        title="`✅` New License Key Created",
        fields=[
            ("License Key", f"`{license_key}`", True),
            ("Expiration Date", f"`{expire_date}`", True),
            ("Owner", f"`{owner}`", True),
            ("Discord", f"`{discord_username}`", True),
            ("Product", f"`{product}`", True),
            ("Allowed IPs", f"`{allowed_ips}`", True),
            ("Allowed Ports", f"`{allowed_ports}`", True),
            ("Creation Date", f"`{created_at}`", True)
        ]
    )
    await interaction.response.send_message(embed=embed)

@tree.command(
    name="license_list",
    description="List all license keys."
)
async def license_list(interaction: discord.Interaction):
    if discord.utils.get(interaction.user.roles, id=ROLE_ID) is None:
        await interaction.response.send_message("`🚫` You don't have the required role to use this command.", ephemeral=True)
        return

    try:
        db = get_db_connection()
        cursor = db.cursor()
        cursor.execute("SELECT * FROM licenses")
        licenses = cursor.fetchall()
        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        await interaction.response.send_message(f"`🚫` Error: {err}", ephemeral=True)
        return

    if not licenses:
        await interaction.response.send_message("`🚫` No licenses found.", ephemeral=True)
        return

    fields = []
    for license in licenses:
        fields.append((
            f"License {license[0]}",
            (
                f"**Key:** `{license[1]}`\n"
                f"**Expire Date:** `{license[2]}`\n"
                f"**Owner:** `{license[3]}`\n"
                f"**Discord:** `{license[4]}`\n"
                f"**Product:** `{license[5]}`\n"
                f"**Allowed IPs:** `{license[6]}`\n"
                f"**Allowed Ports:** `{license[7]}`\n"
                f"**Creation Date:** `{license[8]}`"
            ),
            False
        ))

    embed = create_embed(
        title="`📜` List of Licenses",
        fields=fields
    )
    await interaction.response.send_message(embed=embed)

@tree.command(
    name="license_delete",
    description="Delete a license key by specifying its key."
)
@app_commands.describe(key="License Key.")
async def license_delete(interaction: discord.Interaction, key: str):
    if discord.utils.get(interaction.user.roles, id=ROLE_ID) is None:
        await interaction.response.send_message("🚫 You don't have the required role to use this command.", ephemeral=True)
        return

    try:
        db = get_db_connection()
        cursor = db.cursor()

        sql = "DELETE FROM licenses WHERE `key` = %s"
        val = (key,)
        cursor.execute(sql, val)
        db.commit()
        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        await interaction.response.send_message(f"`🚫` Error: {err}", ephemeral=True)
        return

    await interaction.response.send_message(f"`✅` License with key `{key}` has been deleted.")

@tasks.loop(hours=24)
async def clean_expired_licenses():
    now = datetime.now().strftime("%Y-%m-%d")
    try:
        db = get_db_connection()
        cursor = db.cursor()
        sql = "DELETE FROM licenses WHERE expire_date < %s"
        cursor.execute(sql, (now,))
        db.commit()
        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        print(f"Error cleaning expired licenses: {err}")

@client.event
async def on_ready():
    try:
        await tree.sync()
        print("Commands synchronized")
    except Exception as e:
        print(f"An error occurred during command synchronization: {e}")

client.run(TOKEN)