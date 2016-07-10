Marble CMS
===

Simple, object-oriented CMS based on Laravel 5.

Installation
---

* Clone the git repository and setup a vhost to the `public/` directory
* Create a database and import the `doc/database/marble-0.3.sql`
* copy the `.env.example` to `.env` and fill in the values
* `composer install`
* Go to yourpage.com/admin/auth/login and login with the username `admin@admin` and password `admin`
* done!

Documentation
---

Work in progress.


### General Information

#### Node

A `Node` is an instantiated `NodeClass`. 

##### Attributes

* id `int`
* class_id `NodeClass`
* parent_id `Node`
* created_at `Datetime`
* updated_at `Datetime`
* sort_order `int`

#### NodeClass

A `NodeClass` is a blueprint object for a `Node`. 

##### Attributes

* id `int`
* name `string`
* allow_children `int`
* named_identifier `string`
* created_at `Datetime`
* updated_at `Datetime`
* icon `string`
* group_id `NodeClassGroup`
* list_children `int`
* locked `int`


#### NodeClassGroup

A `NodeClassGroup` is a group of `NodeClass` objects. 
You can group your `NodeClass` objects in types, for example `System` classes (Folders), `Content` classes (News Article, Simple pages,... ).

##### Attributes

* id `int`
* name `string`

#### NodeClassAttribute

#### NodeTranslation

#### ClassAttribute

#### ClassAttributeGroup

#### Attribute

#### Language

---

### Classes

#### Creating a new Class

---

### Attributes

#### Creating a new Attribute

---

### Nodes

#### Creating a new Node


---


Screenshots
---

### Simple 

![Simple Node Screenshot](https://raw.githubusercontent.com/stdclass/marble/master/doc/screenshots/simple-node.png)
Simple node object in edit mode.


![Simple Class Screenshot](https://raw.githubusercontent.com/stdclass/marble/master/doc/screenshots/simple-class.png)
Simple class in edit mode.

### More Complex 

![More complex Node Screenshot](https://raw.githubusercontent.com/stdclass/marble/master/doc/screenshots/complex-node.png)
More complex node object in edit mode.


![More complex Class Screenshot](https://raw.githubusercontent.com/stdclass/marble/master/doc/screenshots/complex-class.png)
More complex class in edit mode.

