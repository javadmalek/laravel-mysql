# RFQ-OFFER State Machine

```
 RFQ               OFFER               ACTIONS
-----------------------------------------------------------------------------
DRAFTED             -                   - PURCHASER: 
                                                    EDIT/REMOVE THE RFQ 
                                                    PUBLISHING THE RFQ-->PUBLISHED
                                        - SUPPLIER : - 
-----------------------------------------------------------------------------
PUBLISHED           DRAFTED             - PURCHASER: -
                                        - SUPPLIER : 
                                                    EDIT / CANCEL THE OFFER
                                                    SENDING THE OFFER-->WAITING
    
PUBLISHED           WAITING             - PURCHASER: 
                                                   MESSAGING
                                        - SUPPLIER : 
                                                   MESSAGING                                                  
-----------------------------------------------------------------------------                                        
                THE DEADLINE IS EXPIRED RFQ-->NEGOTIATING
       
NEGOTIATING         DRAFTED          - PURCHASER: -
                                     - SUPPLIER : -
    
NEGOTIATING         WAITING          - PURCHASER: 
                                                REJECT THE OFFER-->REJECTED
                                                MAKING A DEAL VIA OFFER THEREFORE RFQ-->DEALING, OFFER(CHOOSEN)-->DEALING
                                                MESSAGING
                                     - SUPPLIER : 
                                                MESSAGING 
    
DEALING             DEALING          - PURCHASER: 
                                              MESSAGING
                                     - SUPPLIER : 
                                              MESSAGING
    
DEALING              WAITING          - PURCHASER: 
                                              MESSAGING
                                      - SUPPLIER : 
                                              MESSAGING
    
DEALING              DRAFTED          - PURCHASER: -
                                      - SUPPLIER : -
-----------------------------------------------------------------------------------
                THE RFQ IS EXPIRED
    
EXPIRED              DRAFTED          - PURCHASER: -
                                      - SUPPLIER : -
                                      
EXPIRED              WAITING          - PURCHASER: -
                                      - SUPPLIER : -
                                      
EXPIRED              DEALING          - PURCHASER: 
                                              TERMINATE THE RFQ THEREFORE RFQ-->TERMINATED , OFFER(IN DEAL)-->TERMINATED AND THE REST OFFERS NO CHANGE 
                                              MESSAGING
                                      - SUPPLIER : 
                                              MESSAGING
------------------------------------------------------------------------------------     
                 THE RFQ IS TERMINATED
       
TERMINATED              DRAFTED         - PURCHASER: -
                                        - SUPPLIER : -
                                      
TERMINATED              WAITING         - PURCHASER: -
                                        - SUPPLIER : -
                                        
TERMINATED              TERMINATED      - PURCHASER: -
                                        - SUPPLIER : -


```


