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
    NombreUsuario varchar(30) not null,
    FechaNacimiento Date not null,
    Password varchar(257) not null,
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
    RazaPadre varchar(30)
);
CREATE TABLE Razas_Idiomas (
    NombreRaza varchar(30) not null,
    NombreIdioma varchar(30) not null
);
CREATE TABLE Idiomas (
    NombreIdioma varchar(30) PRIMARY KEY
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
CREATE TABLE Clases_EspacioConjuros (
    NombreClase varchar(30) not null,
    Id int not null
);
CREATE TABLE EspacioConjuros (
    Id int PRIMARY KEY,
    NivelClase int not null,
    NumeroConjuros int not null
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

ALTER TABLE Clases_EspacioConjuros
ADD FOREIGN KEY (NombreClase) REFERENCES Clases(NombreClase);
ALTER TABLE Clases_EspacioConjuros
ADD FOREIGN KEY (Id) REFERENCES EspacioConjuros(Id);

INSERT INTO Usuarios (NombreUsuario,Password,Email)
VALUES ('carlos','carlos123','carlos@gmail.com');

ALTER TABLE Razas_Idiomas
ADD FOREIGN KEY (NombreRaza) REFERENCES Razas(NombreRaza);
ALTER TABLE Razas_Idiomas
ADD FOREIGN KEY (NombreIdioma) REFERENCES Idiomas(NombreIdioma);

INSERT INTO Usuarios (NombreUsuario,FechaNacimiento,Password,Email)
VALUES ('carlos','2000-02-28','AC9C2C34C9F7AD52528C3422AF40A66E2E24AAF2A727831255413C9470158984','carlos@gmail.com');

INSERT INTO Armas (NombreArma,TipoArma,Coste,Dano,TipoDano,Peso)
VALUES ('Baston','Cuerpo a cuerpo sencilla','2pp','1d6','Contundente',4),
('Clava','Cuerpo a cuerpo sencilla','1pp','1d4','Contundente',2);

INSERT INTO PropiedadesArma (NombrePropiedadArma,Descripcion)
VALUES ('Versatil','Esta arma puede usarse con una o dos manos. Entre paréntesis aparece también un valor de daño: es el daño que inflige cuando se usa para hacer un ataque cuerpo a cuerpo con dos manos.'),
('Ligera','Un arma ligera es pequeña y fácil de manejar, ideal para luchar con dos armas.');

INSERT INTO Armas_PropiedadesArma VALUES ('Baston','Versatil'),('Clava','Ligera');

INSERT INTO Armaduras (NombreArmadura,TipoArmadura,Coste,CA,MaximoDestreza,RequisitoFuerza,Sigilo,Peso)
VALUES ('Acolchada','Ligera','5po',11,-1,null,'desventaja',8),
('Pieles','Media','10po',12,2,null,null,12);

INSERT INTO Objetos (NombreObjeto,Descripcion,Coste,Peso)
VALUES ('Raciones(1 dia)',null,'5pp',2),('Saco de dormir',null,'1po',7);

INSERT INTO Conjuros(NombreConjuro,TiempoLanzamiento,Alcance,Componentes,Duracion,Descripcion,Salvacion)
VALUES ('Armadura de mago','1 accion','toque','V,S,M(un trozo de cuero curtido)','8 horas','Tocas a una criatura voluntaria, que no esté portando una armadura, y una fuerza mágica protectora la rodea hasta el fin de la duración del conjuro. La CA base del objetivo se vuelve 13 + su modificador de Destreza. El conjuro finaliza si el receptor se pone una armadura o si tú cancelas el conjuro como una acción.',null),
('Proyectil magico','1 accion','120 pies(24 casillas, 36 m)','V,S','instantanea','Creas tres dardos brillantes de fuerza mágica. Cada dardo impacta a una criatura de tu elección que puedas ver dentro del alcance. Un dardo inflige 1d4 + 1 puntos de daño por fuerza a su objetivo. Todos los dardos impactan a la vez, y los puedes dirigir para que impacten a una criatura o a varias. A niveles superiores. Cuando lanzas este hechizo usando un espacio de conjuros de nivel 2 o superior, el conjuro crea un dardo más por cada nivel de espacio de conjuros por encima de nivel 1.',null);

INSERT INTO Dotes (NombreDote,Requisito,Descripcion)
VALUES ('acechador','Destreza 13 o super(ior','Eres un experto en ocultarte en las sombras. Ganas los siguientes beneficios: • Puedes intentar esconderte cuando estás en penumbra de la criatura de la cual te estás ocultando. • Cuando estás escondido de una criatura y fallas con un arma a distancia, hacer el ataque no delatará tu posición. • La luz tenue no supone una desventaja para tus tiradas de Sabiduría (Percepción) si estas se basan en la vista.'),
('Actor',null,'Eres experimentado en la imitación y en el arte del drama. Ganas los siguientes beneficios: • Incrementa tu puntuación de Carisma en 1, hasta un máximo de 20. • Tienes ventaja en las tiradas de Carisma (Engañar) y Carisma (Interpretar) cuando intentas hacerte pasar por otra persona. • Puedes imitar el habla de otra persona o los sonidos hechos por otras criaturas. Debes haber oído a la persona hablar, o haber escuchado a la criatura haber hecho el sonido, por al menos un minuto. Una tirada exitosa de Sabiduría (Averiguar Intenciones) contra tu tirada de Carisma (Engañar) permite a alguien o algo que escucha determinar que el efecto es falso.');

INSERT INTO Clases (NombreClase,Descripcion,DG,CaracteristicaPrimaria,CompetenciasSalvacion,CompetenciasArmas,CompetenciasArmaduras,EquipoInicial,Rasgos,TrucosConocidos,ConjurosConocidos)
VALUES ('Guerrero','Un maestro del combate marcial, competente con una gran variedad de armas y armaduras.',10,'fuerza o destreza','fuerza y contitucion','Todas las armaduras, escudos, armas simples y marciales.','todas',null,null,0,0),
('Mago','Un usuario de magia educado capaz de manipular la estructura de la realidad.',6,'Inteligencia','Inteligencia y sabiduria','Dagas, dorados, hondas, bastones, ballestas ligeras',null,null,null,3,6);

INSERT INTO Razas (NombreRaza,IncrementoEstadistica,Dimension,Velocidad,Vision,RazaPadre)
VALUES ('Elfo','Destreza 2','mediano',30,'vision en la oscuridad',null),('Alto Elfo','Inteligencia 1',null,null,null,'Elfo');