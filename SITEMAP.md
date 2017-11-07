# INDUSTRIAL RFQ 

## Functional Relations and Structure

    .Homepage
    
    ├── Sign Up        # A company would input all its company information   
    ├── Log In  
    │      ├── Administratior User Dashboard       # called as Manager 
    │      │      ├── Companies
    │      │      │      ├── List of the Registration Requests
    │      │      │      │      ├── Confirm a registartion ==> GoTo ListOfCompanies to set its accounts up
    │      │      │      │      └── Remove
    │      │      │      ├── Create Comapny
    │      │      │      ├── List of Companies       # Both purchaser and salesperson companies can be merged here(suggested) or separated into two different sections
    │      │      │      │      ├── Update
    │      │      │      │      ├── Remove
    │      │      │      │      ├── View a profile
    │      │      │      │      ├── Disable a Comapny
    │      │      │      │      ├── Search for a Comapny
    │      │      │      │      ├── Media
    │      │      │      │      │ 
    │      │      │      │      ├── Accounts management for every company
    │      │      │      │      │      ├── Update
    │      │      │      │      │      ├── Disable
    │      │      │      │      │      └── Remove
    │      │      │      │      │                
    │      │      │      │      ├── Notification
    │      │      │      │      │      ├── Send a notification
    │      │      │      │      │      └── List of notifications
    │      │      │      │      │                
    │      │      │      │      ├── Catalogs of the Comapny
    │      │      │      │      │      ├── Add a Catalog
    │      │      │      │      │      ├── List of Catalogs
    │      │      │      │      │      │      ├── Update 
    │      │      │      │      │      │      ├── Update 
    │      │      │      │      │      │      ├── View  
    │      │      │      │      │      │      ├── Search for a Catalog
    │      │      │      │      │      │      └── Media
    │      │      │      │      │      └──         
    │      │      │      │      │                
    │      │      │      │      ├── Channels of the company    
    │      │      │      │      │       ├── Update
    │      │      │      │      │       ├── Remove
    │      │      │      │      │       ├── View
    │      │      │      │      │       └── List of RFQs in a channel
    │      │      │      │      │                
    │      │      │      │      ├── RFQs of the company       # Only for PURCHASER companies
    │      │      │      │      │       ├── Update
    │      │      │      │      │       ├── Remove
    │      │      │      │      │       ├── View
    │      │      │      │      │       └── Filtering by channel
    │      │      │      │      │                
    │      │      │      │      ├── Offers of the company     # Only for SUPPLIER companies
    │      │      │      │      │       ├── Update
    │      │      │      │      │       ├── Remove
    │      │      │      │      │       ├── View
    │      │      │      │      │       └── Filtering by channel
    │      │      │      │      │                
    │      │      │      │      └── 
    │      │      │      │ 
    │      │      │      ├── RFQs
    │      │      │      │      ├── Create an RFQ-Template
    │      │      │      │      └── Filtering by channel
    │      │      │      │ 
    │      │      │      ├── Offers
    │      │      │      │      ├── Update
    │      │      │      │      ├── Remove
    │      │      │      │      ├── View
    │      │      │      │      └── Search
    │      │      │      │ 
    │      │      │      │ 
    │      │      │      └── 
    │      │      │
    │      │      │
    │      │      │
    │      │      └──     
    │      │      
    │      │      
    │      │      
    │      │      
    │      ├── Purchaseing Office User Dashboard       # called as Purchaser 
    │      │       ├── Profile
    │      │       │      ├── view
    │      │       │      ├── Update
    │      │       │      ├── Media
    │      │       │      ├── Add a Catalog
    │      │       │      ├── My Catalogs
    │      │       │      │      ├── Update
    │      │       │      │      ├── Remove
    │      │       │      │      ├── View
    │      │       │      │      ├── Media
    │      │       │      │      └── Disable
    │      │       │      ├── Add a new Account
    │      │       │      ├── Account Settings
    │      │       │      │      ├── Update
    │      │       │      │      ├── Disable
    │      │       │      │      └── Remove
    │      │       │      └── 
    │      │       │
    │      │       ├── Channels
    │      │       │      ├── Create a channel          # Only for EXCLUSIVE ACCOUNTS
    │      │       │      ├── My channels
    │      │       │      │      ├── Update
    │      │       │      │      ├── Remove
    │      │       │      │      │
    │      │       │      │      ├── Create an RFQ
    │      │       │      │      │      ├── Import an RFQ-Template  ==> GoTo AddCustomizedPairs
    │      │       │      │      │      └── Add many customized paires of (key,value)  ==> GoTo MyRFQs
    │      │       │      │      ├── My RFQs 
    │      │       │      │      │      ├── Update
    │      │       │      │      │      ├── View
    │      │       │      │      │      ├── Remove
    │      │       │      │      │      ├── Media (3D/JPEG/... files)
    │      │       │      │      │      ├── Offers ==> GoTo ReceivedOffers
    │      │       │      │      │      ├── Message Supplier
    │      │       │      │      │      └── RFQ logs
    │      │       │      │      ├── All RFQs  
    │      │       │      │      │      ├── View
    │      │       │      │      │      └── Search
    │      │       │      │      │
    │      │       │      │      └── channel logs
    │      │       │      │
    │      │       │      └── Search for a channel
    │      │       │
    │      │       │
    │      │       ├── Received Offers
    │      │       │      ├── Remove
    │      │       │      ├── View the offer
    │      │       │      ├── View the profile of the supplier
    │      │       │      ├── Reject
    │      │       │      ├── Accept to chat
    │      │       │      ├── Accept to make a deal
    │      │       │      ├── Messageing
    │      │       │      │
    │      │       │      ├── Open an Issue
    │      │       │      ├── Issues
    │      │       │      │      ├── Replay
    │      │       │      │      ├── Close
    │      │       │      │      ├── Refer to Admin
    │      │       │      │      └── Attach file
    │      │       │      │
    │      │       │      ├── Rating
    │      │       │      │      ├── View the rating of supplier
    │      │       │      │      └── Rate a Supplier
    │      │       │      │
    │      │       │      ├── Search
    │      │       │      └── Terminate an Offer
    │      │       │
    │      │       │
    │      │       └── Notifications
    │      │
    │      │
    │      │
    │      │
    │      │
    │      │
    │      ├── Sales Office User Dashboard     # called as Supplier or salesperson 
    │      │      ├── Profile
    │      │      │      ├── view
    │      │      │      ├── Update
    │      │      │      ├── Media
    │      │      │      ├── Add a Catalog
    │      │      │      ├── My Catalogs
    │      │      │      │      ├── Update
    │      │      │      │      ├── Remove
    │      │      │      │      ├── View
    │      │      │      │      ├── Media
    │      │      │      │      └── Disable
    │      │      │      ├── Add a new Account
    │      │      │      ├── Account Settings
    │      │      │      │      ├── Update
    │      │      │      │      └── Remove
    │      │      │      └── 
    │      │      │
    │      │      ├── Channels
    │      │      │      ├── Create a channel            # Only for EXCLUSIVE ACCOUNTS
    │      │      │      ├── My channels
    │      │      │      │      ├── Update
    │      │      │      │      ├── Remove
    │      │      │      │      ├── Search 
    │      │      │      │      │
    │      │      │      │      ├── All RFQs  
    │      │      │      │      │      ├── View
    │      │      │      │      │      ├── Offering         # Load the RFQ features and fill them up
    │      │      │      │      │      │      └── Submitting    ==> GoTo MyOffer
    │      │      │      │      │      ├── View
    │      │      │      │      │      ├── View
    │      │      │      │      │      ├── View
    │      │      │      │      │      └── Search
    │      │      │      │      └── channel logs
    │      │      │      │
    │      │      │      └── Search for a channel
    │      │      ├── My Offers
    │      │      │      ├── View the profile of the Purchaser
    │      │      │      ├── Cancel an offer
    │      │      │      ├── Accept to make a deal
    │      │      │      ├── Messageing
    │      │      │      │
    │      │      │      ├── Open an Issue
    │      │      │      ├── Issues
    │      │      │      │      ├── Replay
    │      │      │      │      ├── Close
    │      │      │      │      ├── Refer to Admin
    │      │      │      │      └── Attach file
    │      │      │      │
    │      │      │      ├── Rating
    │      │      │      │      ├── View the rating of Purchaser
    │      │      │      │      └── Rate a Supplier
    │      │      │      │
    │      │      │      ├── Search
    │      │      │      └── Terminate an Offer
    │      │      │
    │      │      │
    │      │      └── Notifications
    │      │      
    │      └──          
    │      
    │      
    │      
    │                  
    │   ## Without Log In    
    ├── How IC-RFQ Works    # A description abour product and what are the functionalities and rules  
    ├── Get start           # How to become a customer
    ├── Pricing  
    ├── Community
    ├── Support
    │      └── Open a ticket (Issue)         
    ├── Search Page  
    │      ├── Search page         
    │      └── Search Results         
    ├── Download Apps  
    └── Search Page  
           ├── Search page         
           └── Search Results   
    
