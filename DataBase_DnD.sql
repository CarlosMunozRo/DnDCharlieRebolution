DROP DATABASE IF EXISTS `DungeonsAndDragons`;

CREATE DATABASE `DungeonsAndDragons`;

USE `DungeonsAndDragons`;

CREATE TABLE PropiedadesArma (
    NombrePropiedadArma varchar(30) PRIMARY KEY,
    Descripcion varchar(1000) not null
);
CREATE TABLE Armas_PropiedadesArma (
    NombreArma varchar(30) not null,
    NombrePropiedadArma varchar(30) not null
);
CREATE TABLE Usuarios (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    NombreUsuario varchar(257) not null,
    Password varchar(20) not null,
    Email varchar(50) not null
);
CREATE TABLE Armas (
    NombreArma varchar(30) PRIMARY KEY,
    TipoArma varchar(20) not null,
    Coste int,
    Dano varchar(20) not null,
    TipoDano varchar(20) not null,
    Peso int
);
CREATE TABLE Armaduras (
    NombreArmadura varchar(30) PRIMARY KEY,
    TipoArmadura varchar(20) not null,
    Coste int,
    CA int not null,
    MaximoDestreza int,
    RequisitoFuerza int,
    Sigilo varchar(20),
    Peso int
);
CREATE TABLE Objetos (
    NombreObjeto varchar(20) PRIMARY KEY,
    Descripcion varchar(1000) not null,
    Coste varchar(20),
    Peso int
);
CREATE TABLE Conjuros (
    NombreConjuro varchar(30) PRIMARY KEY,
    TiempoLanzamiento varchar(30) not null,
    Alcance varchar(10) not null,
    Componentes varchar(50) not null,
    Duracion varchar(50) not null,
    Descripcion varchar(5000) not null,
    Salvacion varchar(20)
);
CREATE TABLE Dotes (
    NombreDote varchar(30) PRIMARY KEY,
    Requisito varchar(100),
    Descripcion varchar(2000) not null
);
CREATE TABLE Usuarios_Personajes (
    UsuarioID int not null,
    PersonajeID int not null
);
CREATE TABLE Personajes_armas (
    PersonajeID int not null,
    NombreArma varchar(30) not null
);
CREATE TABLE Personajes_Armaduras (
    PersonajeID int not null,
    NombreArmadura varchar(30) not null
);
CREATE TABLE Personajes_Objetos (
    PersonajeID int not null,
    NombreObjeto varchar(20) not null
);
CREATE TABLE Personajes_Conjuros (
    PersonajeID int not null,
    NombreConjuro varchar(30) not null
);
CREATE TABLE Personajes_Dotes (
    PersonajeID int not null,
    NombreDote varchar(30) not null    
);
CREATE TABLE Personajes (
    PersonajeID int PRIMARY KEY,
    Nombre varchar(50),
    Clase varchar(20),
    Trasfondo varchar(50),
    Raza varchar(20),
    Alineamiento varchar(20),
    Experiencia int,
    RasgosPersonalidad varchar(200),
    Ideales varchar(200),
    Vinculos varchar(200),
    Defectos varchar(200),
    Nivel int,
    PGMaximos int,
    CA int,
    Fuerza int,
    Destreza int,
    Constitucion int,
    inteligencia int,
    Sabiduria int,
    Carisma int,
    RasgosAtributos varchar(1000)
);
CREATE TABLE Trasfondo (
    Nombre varchar(30) PRIMARY KEY,
    Descripcion varchar(500) not null,
    HabilidadesAdicionales varchar(50),
    LenguajeAdicional varchar(50),
    Herramientas varchar(200)
);
CREATE TABLE Razas (
    NombreRaza varchar(30) PRIMARY KEY,
    IncrementoEstadistica varchar(10) not null,
    Dimension varchar(20) not null,
    Velocidad varchar(10) not null,
    Vision varchar(20) not null,
    IdiomasRaciales varchar(30) not null,
    RazaPadre varchar(30)
);
CREATE TABLE Clases (
    NombreClase varchar(30) PRIMARY KEY,
    Descripcion varchar(200) not null,
    DG int not null,
    CaracteristicaPrimaria varchar(20) not null,
    CompetenciasSalvacion varchar(30) not null,
    CompetenciasArmas varchar(50),
    CompetenciasArmaduras varchar(50),
    EquipoInicial varchar(200),
    Rasgos varchar(50),
    TrucosConocidos int,
    ConjurosConocidos int,
    EspaciosConjuroPorNivel varchar(30)
);
CREATE TABLE Razas_HabilidadesRaciales (
    NombreRaza varchar(30) not null,
    NombreHabilidadRacial varchar(50) not null
);
CREATE TABLE Clases_HabilidadesClase (
    NombreClase varchar(30) not null,
    NombreHabilidadesClase varchar(50) not null
);
CREATE TABLE HabilidadesClase (
    NombreHabilidadesClase varchar(50) PRIMARY KEY,
    Descripcion varchar(1000)
);
CREATE TABLE HabilidadesRaciales (
    NombreHabilidadRacial varchar(50) PRIMARY KEY,
    Descripcion varchar(1000)
);

ALTER TABLE Armas_PropiedadesArma
ADD FOREIGN KEY (NombreArma) REFERENCES Armas(NombreArma);
ALTER TABLE Armas_PropiedadesArma
ADD FOREIGN KEY (NombrePropiedadArma) REFERENCES PropiedadesArma(NombrePropiedadArma);

ALTER TABLE Usuarios_Personajes
ADD FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID);
ALTER TABLE Usuarios_Personajes
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);

ALTER TABLE Personajes_armas
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_armas
ADD FOREIGN KEY (NombreArma) REFERENCES Armas(NombreArma);

ALTER TABLE Personajes_Armaduras
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Armaduras
ADD FOREIGN KEY (NombreArmadura) REFERENCES Armaduras(NombreArmadura);

ALTER TABLE Personajes_Objetos
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Objetos
ADD FOREIGN KEY (NombreObjeto) REFERENCES Objetos(NombreObjeto);

ALTER TABLE Personajes_Conjuros
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Conjuros
ADD FOREIGN KEY (NombreConjuro) REFERENCES Conjuros(NombreConjuro);

ALTER TABLE Personajes_Dotes
ADD FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID);
ALTER TABLE Personajes_Dotes
ADD FOREIGN KEY (NombreDote) REFERENCES Dotes(NombreDote);

ALTER TABLE Clases_HabilidadesClase
ADD FOREIGN KEY (NombreClase) REFERENCES Clases(NombreClase);
ALTER TABLE Clases_HabilidadesClase
ADD FOREIGN KEY (NombreHabilidadesClase) REFERENCES HabilidadesClase(NombreHabilidadesClase);

ALTER TABLE Razas_HabilidadesRaciales
ADD FOREIGN KEY (NombreRaza) REFERENCES Razas(NombreRaza);
ALTER TABLE Razas_HabilidadesRaciales
ADD FOREIGN KEY (NombreHabilidadRacial) REFERENCES HabilidadesRaciales(NombreHabilidadRacial);

INSERT INTO Usuarios (NombreUsuario,Password,Email)
VALUES ('carlos','carlos123','carlos@gmail.com');