# Development process

## Starting Point
- [x] Creating a new project in LARAVEL to start
- [x] Creating a new project on gitLab and doing the preliminary settings in SourceTree
- [x] Making the Database in MySQL and establishing the connection with PHP project
- [x] Implementing the Authentication as follows:
    * Two different kind of accounts PURCHASER OFFICE and SALES OFFICE
    * One AuthController with redirecting manager
- [x] Implementing a router for managing all the incoming HTTP requests

## Database and Architecture Design
- [ ] Designing the whole database to satisfy the SIGIT requirements
    - [ ] The basic tables contains the companies and relevant tables
    - [ ] The RFQ and offering tables  
- [ ] Extracting the main processes of applications are going to impalement in first version.

 



#Development Tasks

### USER ACCOUNTS
- [x] Authentication
    - [x] Singing up a user
    - [x] Password recovery vi email
    - [x] Sign In and Token Creation
    - [x] Routing of user to their dashboards
    
### PURCHASER
- [ ] Profile
    - [x] Create a profile for a new user
    - [x] Edit a profile for a user
    - [x] Crete a View for profile
    - [ ] Splitting into many steps
    - [ ] Test cases for profile
- [ ] Channels
    - [x] Create a table/migration/seed channel by user
    - [x] Create a new channel by user
    - [ ] Test cases for channels
    - [x] Edit/Remove/List/View channel by user
    - [ ] adding the sector/subsector/subgroup to channel identification by hasMany&belongTo
        - [x] Create a table/migration/seed for sector/subsector/subgroup
        - [x] Create a Model/Controller for sector/subsector/subgroup
        - [ ] Modifying the channel specifications to select default values in CHANNEL_EDIT 
- [ ] RFQs
    - [x] Create a table/migration/seed/test RFQ - basic items 
    - [x] Create a new RFQ by user  - basic items
    - [x] Controller for Edit/Remove/List/View RFQ by user - basic items
    - [ ] Create a table/migration/seed/test RFQ - sub items (Specifications, Prices, Medias, Schedules)
    - [ ] Create a new RFQ by user  - sub items (Specifications, Prices, Medias, Schedules)
    - [ ] Controller for Edit/Remove/List/View RFQ by user - sub items (Specifications, Prices, Medias, Schedules)
    - [ ] Deploying the Test cases for RFQs
    - [ ] Adding the _purchaser_company_id to RFQ model

- [x] MINIO S3 
    - [x] Setup and .env settings
    - [x] Save in dbs
    - [ ] Remove

## Code Cleaning and Coherency
### CSS JS
- [ ] Moving all the CSS and JS files from demo to their suitable directories
- [ ] Moving unwanted JS imports to best fit places
