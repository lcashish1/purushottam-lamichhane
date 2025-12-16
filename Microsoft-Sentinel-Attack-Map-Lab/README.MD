# AZURE SENTINEL HONEYPOT SOC LAB
=======================================

## OVERVIEW
--------
This project demonstrates a hands-on Security Operations Center (SOC) lab built using Microsoft Azure and Microsoft Sentinel.
A Windows virtual machine is deployed as a honeypot to attract failed login attempts. Security logs are collected, enriched
with geolocation data, and visualized using a live attack map in Microsoft Sentinel.

This lab is based on practical learning and inspired by Josh Madakor’s
Cyber Home Lab Catch Attackers! Free, Easy, and REAL (Microsoft Sentinel 2025).


# ARCHITECTURE
------------
- Azure Subscription
- Resource Group
- Windows Virtual Machine (Honeypot)
- Network Security Group (Open inbound traffic)
- Log Analytics Workspace (LAW)
- Microsoft Sentinel (SIEM)
- Azure Monitor Agent (AMA)
- Data Collection Rules (DCR)
- Sentinel Watchlists (GeoIP)
- Sentinel Workbooks (Attack Map)


# TOOLS & TECHNOLOGIES
-------------------
- Microsoft Azure Portal
- Microsoft Sentinel
- Log Analytics Workspace
- Azure Monitor Agent (AMA)
- Windows Event Viewer
- Kusto Query Language (KQL)
- GeoIP CSV Watchlist
- Sentinel Workbooks


# LAB IMPLEMENTATION STEPS
------------------------
1. Created an Azure account and logged into the Azure portal.  
📸 **Screenshot:** Azure Portal Dashboard  
![Azure Portal Dashboard](Project%20Git/01-azure-portal-dashboard.png)

2. Created required Azure resources including:
   - Resource Group
   - Virtual Network
   - Windows Virtual Machine  
📸 **Screenshot:** Azure Resources Created  
![Azure Resources Created](Project%20Git/02-azure-resources-created.png)
![Azure Resources Created](Project%20Git/022-azure-resources-created.png)
![Azure Resources Created](Project%20Git/023-azure-resources-created.png)

3. Configured the Network Security Group (NSG) to allow all inbound traffic
   to expose the VM as a honeypot.  
📸 **Screenshot:** NSG Inbound Rule Configuration  
![NSG Inbound Rule Configuration](Project%20Git/03-nsg-allow-all-inbound.png)

4. Logged into the Windows VM and disabled Windows Firewall.  
📸 **Screenshot:** Windows Firewall Disabled  
![Windows Firewall Disabled](Project%20Git/04-windows-firewall-disabled.png)

5. Generated failed login attempts using incorrect credentials to create
   security events.  
📸 **Screenshot:** Failed Login Attempts  
![Failed Login Attempts](Project%20Git/05-failed-login-attempts.png)

6. Verified failed login events (Event ID 4625) using Windows Event Viewer.  
📸 **Screenshot:** Event Viewer – Event ID 4625  
![Event Viewer 4625](Project%20Git/06-event-viewer-4625.png)

7. Created a Log Analytics Workspace to act as a central log repository.  
📸 **Screenshot:** Log Analytics Workspace  
![Log Analytics Workspace](Project%20Git/07-log-analytics-workspace.png)

8. Added Microsoft Sentinel and connected it to the Log Analytics Workspace.  
📸 **Screenshot:** Microsoft Sentinel Connected  
![Microsoft Sentinel Connected](Project%20Git/08-microsoft-sentinel-connected.png)

9. Enabled the “Windows Security Events via AMA” data connector.  
📸 **Screenshot:** Windows Security Events via AMA  
![Windows Security Events via AMA](Project%20Git/09-ama-data-connector.png)

10. Created a Data Collection Rule (DCR) to collect Windows security logs.  
📸 **Screenshot:** Data Collection Rule  
![Data Collection Rule](Project%20Git/10-data-collection-rule.png)

11. Verified Azure Monitor Agent installation by checking:  
    VM > Settings > Extensions + applications  
    Status: Provisioning succeeded  
📸 **Screenshot:** Azure Monitor Agent Status  
![Azure Monitor Agent Status](Project%20Git/11-azure-monitor-agent-installed.png)

12. Queried logs in Log Analytics Workspace and Sentinel using KQL.  
📸 **Screenshot:** KQL SecurityEvent Query  
![KQL SecurityEvent Query](Project%20Git/12-kql-securityevent-query.png)

13. Identified that SecurityEvent logs contain IP addresses but no geographic data.  
📸 **Screenshot:** SecurityEvent Logs Without Geo Data  
![SecurityEvent Logs](Project%20Git/13-securityevent-without-geo.png)

14. Imported a GeoIP CSV file as a Microsoft Sentinel Watchlist to enrich logs
    with latitude, longitude, city, and country information.  
    - Name/Alias: geoip  
    - Source type: Local file  
    - Search key: network  
    - Rows: ~54,000  
📸 **Screenshot:** GeoIP Watchlist Imported  
![GeoIP Watchlist](Project%20Git/14-geoip-watchlist.png)

15. Used KQL to enrich failed login events with geolocation data using
    the GeoIP watchlist.  
📸 **Screenshot:** GeoIP Enriched KQL Query  
![GeoIP Enrichment Query](Project%20Git/15-geoip-enrichment-query.png)

`` kql
let GeoIPDB_FULL = _GetWatchlist("geoip");
let WindowsEvents = SecurityEvent
| where EventID == 4625
| order by TimeGenerated desc
| evaluate ipv4_lookup(GeoIPDB_FULL, IpAddress, network);
WindowsEvents

16. Created a new Microsoft Sentinel Workbook to visualize attack data.  
📸 **Screenshot:** Sentinel Workbook Creation  
![Sentinel Workbook](Project%20Git/16-sentinel-workbook-created.png)

17. Removed default templates and added a custom query-based visualization
    using the Advanced Editor with custom JSON configuration.  
📸 **Screenshot:** Workbook Advanced Editor  
![Workbook Advanced Editor](Project%20Git/17-workbook-advanced-editor.png)

18. Configured a map visualization to display live global attack data
    based on enriched geolocation information.  
📸 **Screenshot:** Live Attack Map  
![Live Attack Map](Project%20Git/18-live-attack-map.png)

19. Successfully visualized real-time failed login attempts on a global map,
    demonstrating live threat activity against the honeypot VM.  
📸 **Screenshot:** Final Attack Map Result  
![Final Attack Map](Project%20Git/19-final-attack-map.png)

# LOG ENRICHMENT (GEOLOCATION)
----------------------------
SecurityEvent logs contain IP addresses but no geographic data.

To enrich the logs:
- Imported a GeoIP CSV file as a Sentinel Watchlist.
- The watchlist includes IP ranges, latitude, longitude, city, and country.

Watchlist details:
- Name/Alias: geoip
- Source type: Local file
- Search key: network
- Rows: ~54,000

# GeoIP Enrichment Query:
-----------------------
let GeoIPDB_FULL = _GetWatchlist("geoip");
let WindowsEvents = SecurityEvent
| where EventID == 4625
| order by TimeGenerated desc
| evaluate ipv4_lookup(GeoIPDB_FULL, IpAddress, network);
WindowsEvents


# WORKBOOK & ATTACK MAP
---------------------
- Created a new Microsoft Sentinel Workbook.
- Removed default templates.
- Added a query-based visualization.
- Used Advanced Editor to paste custom JSON configuration.
- Configured map visualization to display live attack data.

# Result:
A real-time global attack map showing failed login attempts
based on enriched geolocation data.


# LEARNING OUTCOMES
-----------------
- Understanding SIEM and SOC architecture
- Windows security log analysis
- Log ingestion using Azure Monitor Agent
- Data Collection Rules (DCR)
- KQL querying and filtering
- Log enrichment using watchlists
- Threat visualization using Sentinel workbooks
- Cloud-based security monitoring


# CREDITS & REFERENCES
--------------------
- Josh Madakor – Cyber Home Lab Series
- Microsoft Sentinel Documentation
- Microsoft Azure Documentation
- GeoIP Watchlist (Josh Madakor GitHub)


# AUTHOR
------
Purushottam (Ashish) Lamichhane
CCNA Certified | Aspiring Cybersecurity Analyst
Hands-on SOC & Cloud Security Labs
