## About TicketSystem
	
# Planning
1.	Answer the cuestions: 
	-	What we create? 
	-	For who we create that ?
	-	What characters will have ?
2.	User stories 
3.	Model our data
4.	Crowling aroun the pages we need for our application

## Answers
1.	Answer the cuestions: 
	-	What we create? We create a ticket system for managing tickets. 
	-	For who we create that ?We are maiking it for Kinguin. 
	-	What characters will have ?
		~	login 
		~	registration 
		~	Calendar 
		~	Reports
		~	Tasks
2.	User stories 
	-	login.
	-	registration. 
	-	Calendar 
	-	Reports. Here we have table with reports and from them we can create tickets.
	-	Tasks.Ticket can be assign to some user.
			todo / doing / done
3.	Model our data

	-tables
		-id
		-table_nuber

	-table_order
		-id
		-table_id

	-orders
		-id
		-table_order_id
		-quantity
		-product_id	
		id table  product_name product_price quantity  
		1   5       kartofi      5lv           2
		
	-product
		-id
		-price
		-name
	

4.  Crowling aroun the pages we need for our application
	-login@index
	-registration@index
	-Calendar@index
	-Reports@index
	-Tasks
		todo@index
		doing@index
		done@index
		new@index

# TicketSystem
# TicketSystem
