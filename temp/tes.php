<?php

#Set the workbook to use and its sheet. In this example we use a spreadsheet that
#comes with the Excel installation called: SOLVSAMP.XLS

$workbook = "C:\tes.XLS";
$sheet = "Quick Tour";

#Instantiate the spreadsheet component.
    $ex = new COM("Excel.sheet") or Die ("Did not connect");

#Get the application name and version    
    print "Application name:{$ex->Application->value}<BR>" ; 
    print "Loaded version: {$ex->Application->version}<BR>"; 

#Open the workbook that we want to use.
    $wkb = $ex->application->Workbooks->Open($workbook) or Die ("Did not open");

#Create a copy of the workbook, so the original workbook will be preserved.
    $ex->Application->ActiveWorkbook->SaveAs("Ourtest");  
    #$ex->Application->Visible = 1; #Uncomment to make Excel visible.

# Read and write to a cell in the new sheet
# We want to read the cell E11 (Advertising in the 4th. Quarter)
    $sheets = $wkb->Worksheets($sheet);    #Select the sheet
    $sheets->activate;                 #Activate it
    $cell = $sheets->Cells(11,5) ;    #Select the cell (Row Column number)
    $cell->activate;                #Activate the cell
    print "Old Value = {$cell->value} <BR>";    #Print the value of the cell:10000
    $cell->value = 15000;            #Change it to 15000
    print "New value = {$cell->value}<BR> ";#Print the new value=15000

#Eventually, recalculate the sheet with the new value.
    $sheets->Calculate;            #Necessary only if calc. option is manual
#And see the effect on total cost(Cell E13)
    $cell = $sheets->Cells(13,5) ;    #Select the cell (Row Column number)
    $number = Number_format($cell->value);
    print "New Total cost =\$$number - was \$47,732 before.<BR>";
#Should print $57,809 because the advertising affects the Corporate overhead in the
# cell formula.

#Example of use of the built-in functions in Excel:
#Function: PMT(percent/12 months,Number of payments,Loan amount)
    $pay = $ex->application->pmt(0.08/12,10,10000); 
    $pay = sprintf("%.2f",$pay);
        print "Monthly payment for $10,000 loan @8% interest /10 months: \$ $pay<BR>"; 
#Should print monthly payment = $ -1,037.03    
    
#Optionally, save the modified workbook
    $ex->Application->ActiveWorkbook->SaveAs("Ourtest");                      
#Close all workbooks without questioning
    $ex->application->ActiveWorkbook->Close("False");    
    unset ($ex);

?> 