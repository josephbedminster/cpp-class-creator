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
	int	i;
	float	f;
	Product();
	Product(const Product & s);
	~Product();
	Product&	operator=(Product &copy);
	get_price() const;
	get_name() const;
	get_id() const;
	void	set_price(const int _price ) const;void	set_name(const std::string _name) const;
	void	set_id(const int _id) const;
private:
	int	_price;	std::string	_name;
protected:
	int	_id;
};

#endif