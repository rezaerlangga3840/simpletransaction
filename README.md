# Simple Transaction
## _The simplest transaction app_

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https:https://github.com/rezaerlangga3840/simpletransaction)

Simple transaction is an simple app to make a transaction

## Create, read, update, and delete transactions and its details

- Create new transaction
- Read transaction
- Update transaction
- Delete transaction
- Create, read, update, and delete the each transactions details

Simple Transaction uses a number of open source projects to work properly:

- Laravel
- Apache Friends
- AdminLTE 3
- and many more!

And of course Simple Transaction itself is open source with a public repository on GitHub.

## Installation

- Create a database named "simpletransaction" in your phpMyAdmin
- Clone the Laravel project to htdocs folder and install the dependencies as usual
- Once the second step is done, go to the "simpletransaction" directory in terminal and type "php artisan migrate" then "php artisan db:seed"

## How to use
### Logging in
- Just type "localhost/simpletransaction" on your browser.
- In login screen, type the email and password. The default email should be "admin@example.com" and the password should be "password". You can change this later in user account setting.
- After the succesful login, you will se the main dashboard and the sidebar on the left
- For logout, point to the "account" in the sidebar then select "Logout"

### Change the email and password
- Point to "account" then point to "Settings" in the sidebar. The account settings form will be opened.
- Type your new email address on the "Alamat e-mail" column
- To change password, type the old password in "Password saat ini" column, then the new ones at "Password baru" column. Old and new password should be different.

### Manage transactions
- Point to "Transaksi" and then "Kelola transaksi" in left pane. Then a table that shows the transactions, total items, total quantity, and the transaction's date will be displayed.

#### Adding new transaction
- In the main page of "Kelola transaksi" page, point to the button marked with "+" above table. Then the form for adding new transaction should be opened. Type the transaction code (kode transaksi) and transaction date (tanggal) on the columns that provided. You can also use datepicker by clicking the calendar sign located at the far right of transaction date column.
- After new transaction added, the details page of newly added transaction should be opened. On this page you can see the detailed transaction you inserted, include add more details (items) of your transaction. To open this page again, from the main page of "Kelola transaksi", you can click the view button, which is a blue button with eye symbol.

#### View existing transaction
- As stated in the "adding new transaction" section above, to view existing transaction is by clicking "view" button, which is colored blue with eye symbol.

#### Edit the existing transaction
- To do this, from the main page of "Kelola transaksi", point to the green-colored button with "paper and pencil" symbol next to each transaction. This button also found on each transaction's details page located just below transaction's description.
- Type the new transaction code and date on the column provided.

#### Delete the existing transaction
- To do this, from the main page of "Kelola transaksi", point to the red button with trash symbol next to the transaction you want to delete. A dialog box should appear. Press OK on the dialog box if you want to delete it.

#### Add details of the transaction
- To add the details of the transaction, on the "view" page of newly added or existing transactions, click the "+" button below the "Daftar item" text.
- Type the item name and item quantity on the columns provided.
- The item should be appear on "Daftar item" table.

#### Edit the details of the transaction
- To edit the details of the transaction, just click green button with "paper and pencil" symbol next to the each transaction detail items. An edit dialog box should be appear. Enter the new value on the provided columns if needed.

#### Delete the details of the transactions
- To do this, from the view page of the transaction, point to the red button with "trash" logo next to transaction's detail items. A dialog box should appear. Press OK on the dialog box if you want to delete it.