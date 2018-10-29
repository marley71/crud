# Cupparis4

Libreria CRUD per la realizzazione di interfacce professionali basate su chiamate rest con 
metodi POST,INSERT,DELETE,UPDATE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `App`. 
            
##Componenti base

###Component
Oggetto astratto principale, tutti gli altri ereditano da questa classe



###Dashboard
La componente dashboard permette di creare interfacce complesse attraverso
l'utilizzo di una composizione di views che interagiscono tra di loro.
<a href="dashboards">Vai</a>

###View
La componente View rappresenta una collezione di dati che possono essere passati manualmente o 
attraverso un server, utilizzando le route che usano le convenzioni REST. A questi dati 
vengono associati dei componenti di tipo `Render`. 
<a href="views">Vai</a>


###Render
Una componente Render rappresenta il dato secondo controlli standard html o plugins 
di varia complessità.

La visualizzazione e la gestione del componente Render è differenziata dal modo in cui un componente
può essere instaziato. I modi con cui può essere istanziato sono:

- VIEW
- EDIT
- SEARCH

Quando il component Render è in modalità view, non permette l'editing dei dati.
Quando è in modalità edit e search permette la modifica dei dati. La modalità search è come l'edit
ma aggiunge la presenza e la gestione di un operatore della search. Nella modalità search il 
nome del campo, per convenzione, viene trasformato come s_{nome_campo}. 

<a href="renders">Vai</a>

###ItemViewTemplate
Permette di costruire un template di contorno per l'oggetto `Render`. Viene utilizzato dalle view
<a href="item-structure">Vai</a>

##Routes
`Route` classe che incapsula l'interazione con il server sia per il recupero sia per la spedizione per i dati.
In genere viene utilizzata da una view e dalle azioni.
<a href="routes">Vai</a>

##App
rappresenta l'oggetto per la gestione della pagina e delle sue varie componenti javascript.
<a href="app">Vai</a>


##Actions

Le azioni raccolgono le interazioni con l'operatore con l'interfaccia.
 <a href="actions">Vai</a>

##Server
Classe che rappresenta un wrapper delle chiamate ajax di jquery.
<a href="server">Vai</a>

