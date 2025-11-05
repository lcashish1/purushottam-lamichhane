# 🏢 Office Network Design – VLAN, NAT & HSRP Redundancy

## 👨‍💻 Author: Purushottam Lamichhane

## 📘 Overview

This project demonstrates a multi-VLAN enterprise network designed in Cisco Packet Tracer.
It simulates a secure small business office network that ensures redundancy, segmentation, and controlled access across departments. It features two routers configured with HSRP for failover and multiple VLANs for departmental separation.


## ⚙️ Features

* VLAN segmentation for different departments

* Dynamic IP assignment using DHCP

* NAT Overload for shared internet access

* HSRP redundancy for high availability

* Layer 3 Inter-VLAN Routing

* Scalable subnet design for future expansion

## 🧩 VLAN & Subnet Details
| VLAN	| Department	| Network	| Subnet Mask        | Gateway      |
|-------|  -------------| --------------|  ------------------|  ------------|
| 10	| Sales        	| 192.168.1.0	| /28                | 192.168.1.1  | 	
| 20	| IT	        | 192.168.1.16	| /28	             | 192.168.1.17 | 	
| 30	| Admin        	| 192.168.1.32	| /29	             | 192.168.1.33 |
| 40	| HR	        | 192.168.1.40	| /29	             | 192.168.1.41 |
| 50	| Guest	        | 192.168.1.48	|/29	             | 192.168.1.49 |

## 🌐 Network Services
DHCP

* Configured on Router1 for all VLANs, providing:

* Default gateway per VLAN

* DNS server assignment

* Domain names per department

NAT

* Implemented as PAT (Overload) for shared public internet access

* Inside: VLAN interfaces

* Outside: WAN interface (G0/0/1)

HSRP

* Both routers use HSRP for gateway redundancy

* Virtual IP acts as the default gateway for each VLAN

## 🧠 Technologies Used

* Cisco Packet Tracer

* IPv4 Subnetting

* VLAN & Trunk Configuration

* Inter-VLAN Routing

* DHCP, NAT, and HSRP

## 🛠️ Tools

* Cisco Packet Tracer

* Cisco 2901 Routers

* Cisco 2960 Switches
 
## 🧾 Folder Structure Example

```
Office-Network-Design/
│
├── README.md
├── Router1_Config.txt
├── Router2_Config.txt
├── Network_Topology.pkt
└── VLAN_Subnet_Plan.xlsx
```
## 📸 Screenshots
DHCP working in same vlan 40. 
<img width="975" height="548" alt="image" src="https://github.com/user-attachments/assets/d34f27e0-81dd-4bc6-acae-231f825f9f6f" />

Successfully getting IP address from DHCP server.
<img width="975" height="515" alt="image" src="https://github.com/user-attachments/assets/dba96e12-2313-48e6-82f5-763747c437cb" />

HSRP 
Secondary (Router2) working as a standby router on HSRP.
<img width="975" height="519" alt="image" src="https://github.com/user-attachments/assets/1f2c6cf7-be24-4534-9c1b-a3c5148edfa2" />

Confirming connection between VLANs and Internet. 
<img width="1919" height="1022" alt="image" src="https://github.com/user-attachments/assets/f90c4abd-1b0e-40d6-9464-4a209ff1dd74" />

Confirming NAT is working 
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/28f77c19-4197-4924-ba21-799086555171" />


Reference:
https://www.cisco.com/c/en/us/support/docs/ip/hot-standby-router-protocol-hsrp/9234-hsrpguidetoc.html
https://community.spiceworks.com/t/how-does-a-dhcp-server-know-what-subnet-to-assign/277176/6
https://www.cisco.com/en/US/docs/ios/12_4t/ip_addr/configuration/guide/htdhcpsv.html


## 🧩 Future Improvements

* Re-implement and test the extended ACLs for better inter-VLAN security.

* Add SNMP and Syslog monitoring for network management.

* Implement redundancy at the switch layer using EtherChannel or STP.
