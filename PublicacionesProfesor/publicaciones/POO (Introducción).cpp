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

	public : // Métodos.
		
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

// Definimos el método "leer" : 

void Persona::leer()
{
	cout<<" Soy "<<nombre<<" y estoy leyendo un libro "<<endl<<endl;
}

// Definimos el método "correr" :

void Persona::correr()
{
	setlocale(LC_ALL, "spanish"); // Declaramos el idioma en español.
	
	cout<<" Soy "<<nombre<<" y estoy corriendo una maratón y tengo "<<edad<<" años."<<endl<<endl;
}

int main()
{
	Persona p1=Persona(20,"Carlos"); // Creamos nuestro objeto (Forma larga).
	Persona p2(19,"Maria"); // Creamos nuestro objeto (Forma Corta).
	Persona p3(21,"juan"); // Creamos nuestro objeto (Forma Corta).
	
	p1.leer(); // Utilizamos o llamamos al primer método.
	p2.correr(); // Utilizamos o llamamos al segundo método.
	
	p3.leer(); // Utilizamos o llamamos al primer método.
	p3.correr(); // Utilizamos o llamamos al segundo método.
	
	getch();
	return 0;
}
