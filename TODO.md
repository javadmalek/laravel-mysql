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
    - [x] Edit/Remove/List channel by user
    - [ ] adding the sector/sub/group to channel identification by hasMany&blongTo
- [ ] RFQ
    - [ ] Create a table/migration/seed RFQ 
    - [ ] Create a table/migration/seed for Sub-items of an RFQ
    - [ ] Create a new RFQ by user
    - [ ] Edit/Remove/List RFQ by user


## Code Cleaning and Coherency
### CSS JS
- [ ] Moving all the CSS and JS files from demo to their suitable directories
 
