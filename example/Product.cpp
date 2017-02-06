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
