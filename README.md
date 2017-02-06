# cpp-class-creator
Create structure of your C++ Class easily with this script. Coplien form valid.

Launch
---
```php
php ClassCreator.php
```
Example input from stdin
```sh
Login : bedmin_j
NOM Prenom : BEDMINSTER Joseph
Nom de la classe : Product
Classe virtuelle ? y/n : n
Include default lib ? y/n : y
Ajouter des variables ? y/n : y
Format des variables à envoyer : [type] [name] (const), ex: int i const, void afficher const
Variables publiques : int i, float f
Variables privées : int _price, std::string _name
Variables protégées : int _id
Fichiers créés : Product.cpp + Product.hh
Ouvrir les fichiers ? y/n : n
```
Example output
---
```cpp
//
// Product.hh for  in /Users/nextjoey/Documents/ETNA - Prep2/Scripts PHP/cpp-class-creator
// 
// Made by BEDMINSTER Joseph
// Login   <bedmin_j@etna-alternance.net>
// 
// Started on  Mon Feb  6 02:56:28 2017 BEDMINSTER Joseph
// Last update Mon Feb  6 02:56:28 2017 BEDMINSTER Joseph
//
#ifndef PRODUCT_HH
# define PRODUCT_HH
#include <string>
#include <iostream>

class Product
{
public:
	int	i;	float	f;
	Product();
	Product(const Product & s);
	 ~Product();
	 Product&	operator=(Product &copy);
	get_price() const;	get_name() const;
	get_id() const;
	void	set_price(const int _price) const;
	void	set_name(const std::string _name) const;
	void	set_id(const int _id) const;
private:
	int	_price;	std::string	_name;
protected:
	int	_id;
};

#endif
```

```cpp
//
// Product.cpp for  in /Users/nextjoey/Documents/ETNA - Prep2/Scripts PHP/cpp-class-creator
// 
// Made by BEDMINSTER Joseph
// Login   <bedmin_j@etna-alternance.net>
// 
// Started on  Mon Feb  6 02:56:28 2017 BEDMINSTER Joseph
// Last update Mon Feb  6 02:56:28 2017 BEDMINSTER Joseph
//
#include "Product.hh"

Product::Product()
{
}

Product::Product(const Product &copy)
{
	this->_price = copy._price;
	this->_name = copy._name;
}

Product::~Product()
{
}

Product& Product::operator=(Product &copy)
{
	this->_price = copy._price;
	this->_name = copy._name;
}


int	Product::get_price() const
{
	return (this->_price);
}

std::string	Product::get_name() const
{
	return (this->_name);
}


int	Product::get_id() const
{
	return (this->_id);
}


void	Product::set_price(const int _price ) const
{
	this->_price = _price;
}

void	Product::set_name(const std::string _name ) const
{
	this->_name = _name;
}


void	Product::set_id(const int _id ) const
{
	this->_id = _id;
}
```
