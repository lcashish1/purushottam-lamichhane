# 🔐 Zero Trust Azure Security with Live Threat Detection & Automated Response (Azure)
________________________________________
## 🎯 Project Objective
This project demonstrates a real-world Zero Trust security architecture implemented in Microsoft Azure, focused on network segmentation, continuous monitoring, threat detection, and automated incident response.
The solution detects SSH brute-force attacks against a Linux VM using Microsoft Sentinel and automatically blocks the attacker IP using Network Security Groups (NSGs) via Logic Apps (SOAR).
This project is designed to be SOC / Cloud Security Engineer recruiter-ready.
________________________________________
## 🧱 Architecture Overview
High-Level Design
•	Identity-based access using Azure Entra ID (Azure AD)
•	Segmented virtual network with strict NSG-based controls
•	Centralized logging and SIEM using Microsoft Sentinel
•	Automated response using Logic Apps
Architecture Diagram
📌 Zero Trust Azure Security Architecture Diagram
(Project%20Git/Architecture.jpg)

________________________________________
## 🧑‍💼 Identity & Access Layer
Azure Entra ID (Azure AD)
•	Users:
o	Network Admin
o	SOC Analyst
o	Test User
•	Conditional Access Policies
•	Multi-Factor Authentication (MFA)
🔐 All Azure resources are accessed using identity-based access control principles.
________________________________________
## 🌐 Networking Layer
Virtual Network
•	VNet: ZT-VNet (10.0.0.0/16)
Subnet Design
1️⃣ Public Subnet
•	Public-Subnet (10.0.1.0/24)
•	Resources:
o	JumpVM (Windows)
•	Security:
o	NSG-Public
o	Restricted inbound access from trusted IP only
2️⃣ Application Subnet
•	App-Subnet (10.0.2.0/24)
•	Resources:
o	AppVM (Linux)
•	Security:
o	NSG-App
o	SSH allowed only from Public-Subnet
3️⃣ Database Subnet (Architecture design)
•	DB-Subnet (10.0.3.0/24)
•	Security:
o	NSG-DB
o	DB port access only from App-Subnet
4️⃣ Attacker Simulation Subnet (Architecture design)
•	Attacker-Subnet (10.0.4.0/24)
•	Purpose:
o	Simulated attack traffic for SOC testing

(Project%20Git/Images1.png)
(Project%20Git/Images2.png)
________________________________________
## 🛡️ Security Controls
Network Security Groups (NSGs)
•	Enforced east–west and north–south traffic control
•	Default deny-all policy
•	Dynamic deny rules created during automated response
(Project%20Git/Images3.png)

Microsoft Defender for Cloud
•	Secure Score monitoring
•	VM threat protection
•	Security posture recommendations
(Project%20Git/Defender-for-cloud.png)
________________________________________
## 👁️ Monitoring & SOC Layer
Log Analytics Workspace
•	Name: ZT-Sentinel-LAW
•	Centralized log storage
Log-and-workplace.png
Microsoft Sentinel (SIEM)
Connected data sources:
•	Azure Activity Logs
•	Azure AD Sign-in Logs
•	Security Events (Linux Syslog)
•	Defender for Cloud alerts
📊 All VM logs are ingested using Azure Monitor Agent (AMA) and Data Collection Rules (DCRs).
(Project%20Git/Sentinel.png)
(Project%20Git/Sentinel-log.png)
________________________________________
## 🧪 Attack Simulation
SSH Brute-Force Test
From JumpVM:
```
ssh wronguser@<AppVM-private-IP>
```
•	Multiple failed login attempts trigger detection
________________________________________
## 🚨 PART 1: Sentinel Detection Rule
Use Case
Detect SSH brute-force attacks against Linux virtual machines.
Detection Logic (KQL)
``` kql
Syslog
| where SyslogMessage has "Invalid user"
| extend RemoteIP = extract(@"from (\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})", 1, SyslogMessage)
| summarize Attempts = count(), SyslogMessage = take_any(SyslogMessage) by RemoteIP, HostIP, bin(TimeGenerated, 5m)
| where Attempts > 5
| project TimeGenerated, RemoteIP, HostIP, Attempts, SyslogMessage
```

Outcome
•	Sentinel incident is automatically created
•	Email alert is sent to SOC analyst
(Project%20Git/Dectection-rule.png)
(Project%20Git/Dectection-rule2.png)
(Project%20Git/Dectection-rule3.png)
________________________________________
## 🤖 PART 2: Automated Response (SOAR)
Logic App Playbook
Trigger:
•	When a Microsoft Sentinel incident is created
Actions:
1.	Retrieve incident details
2.	Extract IP entities
3.	Identify attacker IP
4.	Create NSG deny rule dynamically
5.	Block attacker traffic automatically
Result
•	Attacker IP is immediately blocked at the network layer
•	Prevents further brute-force attempts

(Project%20Git/Dectection-rule4.png)
(Project%20Git/Dectection-rule5.png)
________________________________________
## 🔁 MITRE ATT&CK Mapping
Technique	ID
Brute Force	T1110
Network Scanning	T1046
Lateral Movement	TA0008
________________________________________
## 📸 Screenshots (Evidence)
(Project%20Git/Soc.png)
(Project%20Git/Logic-app.png)
________________________________________
## 🎯 Skills Demonstrated
•	Azure Networking & NSGs
•	Zero Trust Architecture
•	Linux Security Logging
•	SIEM (Microsoft Sentinel)
•	KQL Analytics Rules
•	SOAR Automation (Logic Apps)
•	Incident Detection & Response
________________________________________
## 💬 Interview Explanation
“I designed and implemented a Zero Trust Azure security architecture where Linux authentication logs are monitored using Microsoft Sentinel. SSH brute-force attempts are detected using KQL analytics rules, and a Logic App playbook automatically blocks attacker IPs using Network Security Groups, demonstrating real SOC automation and threat containment.”
________________________________________
## 🚀 Future Enhancements
•	Auto-expiry NSG block rules
•	Threat Intelligence IP reputation checks
•	Azure Firewall integration
•	Teams / Slack alerting
________________________________________
## 🏁 Conclusion
This project showcases an end-to-end cloud SOC implementation using native Azure security services, closely aligning with real enterprise security operations.
⭐ If you found this project useful, feel free to star the repository!
