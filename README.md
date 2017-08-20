# Site API KEY - Overview


This is the Git repo of SiteAPI Key and API that responds with a JSON representation of a given node with the content type 'page'.

## Features


A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.

When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".

A Drupal message should inform the user that the Site API Key has been saved with that value.

When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.

The text of the "Save configuration" button should change to "Update Configuration".

This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".


## Usage

Enable module siteapi

Login as Admin and Go to admin/config/system/site-information

Add New API Key


## Example URL

http://localhost/page_json/[APIKEY]/[NodeID]

### Spent Time
  First 5 tasks regarding form 'Site Information' - 1 hrs.
  Json Response - 1 hrs
  Virtual Host creation, Drupal 8 New Instaltion, Git repo Creation etc- 0.50 hrs
  Total 2.50 Hrs.

### Referances

  Json Response - https://symfony.com/doc/current/introduction/http_fundamentals.html
