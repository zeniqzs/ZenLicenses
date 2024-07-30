package org.zenlicensesmc;

import org.bukkit.Bukkit;
import org.bukkit.configuration.file.FileConfiguration;
import org.bukkit.plugin.java.JavaPlugin;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;

public class ZenLicensesMc extends JavaPlugin {

    private String serverIP;
    private int serverPort;
    private String pluginName;
    private String key;
    public static String RESET = "\u001B[0m";
    public static String BLACK = "\u001B[30m";
    public static String RED = "\u001B[31m";
    public static String GREEN = "\u001B[32m";
    public static String YELLOW = "\u001B[33m";
    public static String BLUE = "\u001B[34m";
    public static String PURPLE = "\u001B[35m";
    public static String CYAN = "\u001B[36m";
    public static String WHITE = "\u001B[37m";
    public static String BOLD = "\u001B[1m";

    @Override
    public void onEnable() {
        saveDefaultConfig();
        FileConfiguration config = getConfig();

        this.pluginName = getDescription().getName();
        this.serverPort = Bukkit.getServer().getPort();
        this.key = config.getString("key");

        if (this.key == null || this.key.isEmpty()) {
            getLogger().severe("No key found in config! Disabling plugin...");
            Bukkit.getPluginManager().disablePlugin(this);
            return;
        }

        try {

            URL url = new URL("https://api.ipify.org");
            BufferedReader in = new BufferedReader(new InputStreamReader(url.openStream()));
            this.serverIP = in.readLine();
            in.close();

            LicensChecker licensChecker = new LicensChecker(serverIP, serverPort, pluginName, key);
            String result = licensChecker.checkLicense();

            if (!result.equals("VALID")) {
                getLogger().severe("License check failed! Disabling plugin...");
                getLogger().severe(result);
                Bukkit.getPluginManager().disablePlugin(this);
            } else {
                getLogger().info(CYAN + BOLD + "________________________________________________");
                getLogger().info(PURPLE + BOLD + "ID: " + licensChecker.getLicenseId());
                getLogger().info(PURPLE + BOLD + "Key: " + licensChecker.getMaskedKey());
                getLogger().info(PURPLE + BOLD + "Owner: " + licensChecker.getOwner());
                getLogger().info(PURPLE + BOLD + "Discord: " + licensChecker.getDiscord());
                getLogger().info(PURPLE + BOLD + "Product: " + licensChecker.getProduct());
                getLogger().info(PURPLE + BOLD + "Expire Date: " + licensChecker.getExpireDate());
                getLogger().info(PURPLE + BOLD + "Creation Date: " + licensChecker.getCreationDate());
                getLogger().info(CYAN + BOLD + "________________________________________________");
            }

        } catch (Exception e) {
            e.printStackTrace();
            getLogger().severe("Error during license check! Disabling plugin...");
            Bukkit.getPluginManager().disablePlugin(this);
        }
    }
}
