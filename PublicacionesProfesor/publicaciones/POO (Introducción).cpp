#include<iostream>
#include<conio.h>
#include<stdlib.h>
#include<locale.h>
using namespace std;

// Declaramos nuestra clase : 

class Persona 
{
	private : // Atributos.
		
		int edad;
	    string nombre;

	public : // M�todos.
		
		Persona(int _edad, string _nombre); // Declaramos el constructor de la clase.
		void leer();
		void correr();
};

// Definimos el Constructor de la clase (Para inicializar los Atributos) :

Persona::Persona(int _edad, string _nombre)
{
	edad=_edad;
	nombre=_nombre;
}

// Definimos el m�todo "leer" : 

void Persona::leer()
{
	cout<<" Soy "<<nombre<<" y estoy leyendo un libro "<<endl<<endl;
}

// Definimos el m�todo "correr" :

void Persona::correr()
{
	setlocale(LC_ALL, "spanish"); // Declaramos el idioma en espa�ol.
	
	cout<<" Soy "<<nombre<<" y estoy corriendo una marat�n y tengo "<<edad<<" a�os."<<endl<<endl;
}

int main()
{
	Persona p1=Persona(20,"Carlos"); // Creamos nuestro objeto (Forma larga).
	Persona p2(19,"Maria"); // Creamos nuestro objeto (Forma Corta).
	Persona p3(21,"juan"); // Creamos nuestro objeto (Forma Corta).
	
	p1.leer(); // Utilizamos o llamamos al primer m�todo.
	p2.correr(); // Utilizamos o llamamos al segundo m�todo.
	
	p3.leer(); // Utilizamos o llamamos al primer m�todo.
	p3.correr(); // Utilizamos o llamamos al segundo m�todo.
	
	getch();
	return 0;
}
