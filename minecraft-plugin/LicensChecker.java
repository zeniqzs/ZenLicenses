package org.zenlicensesmc;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class LicensChecker {

    private final String serverIP;
    private final int serverPort;
    private final String pluginName;
    private final String key;

    private String licenseId;
    private String owner;
    private String discord;
    private String product;
    private String expireDate;
    private String creationDate;

    public LicensChecker(String serverIP, int serverPort, String pluginName, String key) {
        this.serverIP = serverIP;
        this.serverPort = serverPort;
        this.pluginName = pluginName;
        this.key = key;
    }

    public String checkLicense() {
        try {
            String requestURL = String.format("https://{YOUR DOMAIN}/dashboard/php/check.php?ip=%s&port=%d&plugin=%s&key=%s",
                    URLEncoder.encode(serverIP, "UTF-8"),
                    serverPort,
                    URLEncoder.encode(pluginName, "UTF-8"),
                    URLEncoder.encode(key, "UTF-8"));

            URL url = new URL(requestURL);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");

            BufferedReader in = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            String response = in.readLine();
            in.close();

            if (response == null || response.isEmpty()) {
                return "No response from license server.";
            }

            if (response.startsWith("VALID")) {
                String[] parts = response.split(";");
                this.licenseId = parts[1];
                this.owner = parts[2];
                this.discord = parts[3];
                this.product = parts[4];
                this.expireDate = parts[5];
                this.creationDate = parts[6];
                return "VALID";
            }

            return response;

        } catch (Exception e) {
            e.printStackTrace();
            return "An error occurred while checking the license.";
        }
    }

    public String getLicenseId() {
        return licenseId;
    }

    public String getOwner() {
        return owner;
    }

    public String getDiscord() {
        return discord;
    }

    public String getProduct() {
        return product;
    }

    public String getExpireDate() {
        return expireDate;
    }

    public String getCreationDate() {
        return creationDate;
    }

    public String getMaskedKey() {
        if (key.length() > 4) {
            return key.substring(0, key.length() - 4) + "****";
        } else {
            return "****";
        }
    }
}
