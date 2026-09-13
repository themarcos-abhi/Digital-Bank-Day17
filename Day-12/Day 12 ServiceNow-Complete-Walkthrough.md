# ServiceNow: Complete Walkthrough

## 1. Introduction to ServiceNow

ServiceNow is a cloud-based platform used primarily for **IT Service Management (ITSM)**, workflow automation, and enterprise service management. It helps organizations manage and automate processes such as incident handling, change management, asset tracking, and employee/customer service requests.

**Key characteristics:**

* Cloud-based, accessed via web browser
* Built on a single data model and platform (the Now Platform)
* Highly configurable with workflows, forms, and automation
* Used across IT, HR, Customer Service, and Security operations

## 2. Core ServiceNow Modules

| Module | Purpose |
|---|---|
| Incident Management | Handles unplanned interruptions or reductions in service quality |
| Problem Management | Identifies and addresses root causes of recurring incidents |
| Change Management | Manages and approves changes to IT systems in a controlled way |
| Request Management (Service Catalog) | Handles user requests for services, hardware, or access |
| Asset Management | Tracks hardware, software, and licenses across their lifecycle |
| CMDB (Configuration Management Database) | Stores information about IT assets (Configuration Items) and their relationships |
| Knowledge Management | Stores articles and documentation for self-service and agent use |
| HR Service Delivery | Manages employee service requests (onboarding, HR cases, etc.) |

## 3. Key Terminology

* **Instance:** A dedicated ServiceNow environment (e.g., a company's own ServiceNow deployment).
* **CI (Configuration Item):** Any component (server, application, network device) tracked in the CMDB.
* **Ticket:** A general term for a record representing work to be done — includes incidents, requests, problems, and changes.
* **SLA (Service Level Agreement):** A defined time frame within which a ticket must be responded to or resolved.
* **Assignment Group:** A team responsible for handling a specific category of tickets.
* **Workflow/Flow Designer:** Tools used to automate business processes within ServiceNow.
* **Update Set:** A package of configuration changes that can be moved between ServiceNow instances (e.g., from development to production).

## 4. Navigating the ServiceNow Interface

* **Application Navigator (left sidebar):** Used to search for and access different modules and applications.
* **Favorites/History:** Quick access to frequently used or recently visited pages.
* **Global Search:** Searches across records, articles, and configuration items.
* **Lists and Forms:**
  * **List view:** Displays multiple records in a table (e.g., all open incidents).
  * **Form view:** Displays the full details of a single record.
* **Filters and Conditions:** Used to narrow down list views based on field values (e.g., State = Open).

## 5. Incident Management Walkthrough

Incident Management addresses issues affecting normal service operation.

### Typical Incident Lifecycle

1. **Log the Incident**
   * Created via self-service portal, email, phone call logged by an agent, or automated monitoring alert.
   * Key fields: Caller, Short description, Description, Category, Impact, Urgency.
2. **Categorize and Prioritize**
   * **Impact** and **Urgency** combine to calculate **Priority** (e.g., Priority 1 = Critical).
3. **Assignment**
   * The incident is routed to the appropriate **Assignment Group** and **Assigned to** agent.
4. **Investigation and Diagnosis**
   * The agent investigates using available tools, knowledge articles, and CMDB relationships.
5. **Resolution**
   * The agent applies a fix, documents the **Resolution notes**, and sets the state to **Resolved**.
6. **Closure**
   * The incident is confirmed resolved (often after a set period) and marked **Closed**.

### Common Incident States

`New → In Progress → On Hold → Resolved → Closed`

## 6. Problem Management Walkthrough

Problem Management focuses on identifying and eliminating the **root cause** of recurring incidents.

1. A **Problem record** is created, often linked to one or more related incidents.
2. **Root Cause Analysis (RCA)** is performed to determine the underlying issue.
3. A **Known Error** may be logged if a workaround exists but a permanent fix is pending.
4. A **Change Request** may be raised to implement the permanent fix.
5. Once resolved, the Problem record is closed, and linked incidents can reference the resolution.

## 7. Change Management Walkthrough

Change Management ensures that changes to IT systems are made in a controlled, low-risk manner.

### Types of Changes

* **Standard Change:** Pre-approved, low-risk, and repeatable (e.g., routine patching).
* **Normal Change:** Requires review and approval through a Change Advisory Board (CAB).
* **Emergency Change:** Urgent changes needed to resolve a critical issue, with expedited approval.

### Typical Change Lifecycle

1. **Create Change Request** — describe the change, justification, and affected CIs.
2. **Risk and Impact Assessment** — evaluate potential impact on services.
3. **Approval** — routed to relevant approvers or the CAB.
4. **Implementation** — the change is carried out during a scheduled change window.
5. **Review/Closure** — the change is reviewed for success and closed, with lessons learned documented if needed.

## 8. Service Catalog and Request Management

* The **Service Catalog** is a self-service portal where users can browse and request items (e.g., new laptop, software access, password reset).
* Submitting a catalog item creates a **Request (REQ)**, which generates one or more **Request Items (RITM)**.
* Each RITM may generate **Tasks (SCTASK)** assigned to fulfillment teams to complete the request.

**Example hierarchy:**
```
Request (REQ0010001)
 └── Request Item (RITM0010001) - "New Laptop"
      └── Catalog Task (SCTASK0010001) - "Procure Hardware"
      └── Catalog Task (SCTASK0010002) - "Configure and Ship"
```

## 9. CMDB (Configuration Management Database)

* Stores **Configuration Items (CIs)** — servers, applications, network devices, databases, etc.
* Tracks **relationships** between CIs (e.g., an application running on a specific server).
* Used to assess the impact of incidents or changes on related systems.
* Populated manually or automatically via **Discovery** tools that scan the network.

## 10. Knowledge Management

* Stores **Knowledge Articles** for troubleshooting steps, FAQs, and how-to guides.
* Agents can link relevant articles to incidents for faster resolution.
* End users can search the knowledge base directly through the self-service portal to resolve issues without logging a ticket.

## 11. Basic Reporting and Dashboards

* **Reports** can be built on any table (e.g., number of incidents by priority, average resolution time).
* **Dashboards** combine multiple reports and performance indicators into a single view.
* Common metrics tracked: SLA compliance, ticket volume, backlog, first-call resolution rate.

## 12. Roles and Access

* **End User:** Submits incidents/requests via the portal.
* **Agent/Fulfiller:** Works on and resolves tickets within their assignment group.
* **Admin:** Configures the platform, manages users, roles, and system settings.
* **ITIL Role:** Grants access to ITSM applications like Incident, Problem, and Change Management.

## 13. Summary

ServiceNow provides a structured framework for managing IT and business services through modules such as Incident, Problem, Change, and Request Management, all built on a common platform and supported by the CMDB. Understanding the ticket lifecycle, module relationships, and navigation basics is the foundation for working effectively within any ServiceNow environment.
