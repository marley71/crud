---
some_url: https://github.com/marley71/crud-vue
extra:
    version: 1.0
---

# CRUD-Vue v1.0 

Framework CRUD per la realizzazione di interfacce professionali basate su chiamate REST con 
metodi CREATE,READ,UPDATE,DELETE. Il protocollo utilizzato per la comunicazione è il json. 
La libreria utilizza il concetto di componente. La pagina è formata da componenti ed esse
sono gestite attraverso l'oggetto principale `CrudApp`. 
Nel framework è definito un oggetto globale crud, accedibile con this.$crud dove sono definiti
dei comportamenti principali delle componenti e che può essere esteso e modificato per le
proprie personalizzazioni.
Il concetto di base è quello di creare una logica e una grafica delle componenti
in modo che ci sia una versione base implementata dalla libreria, ma che sia customizzabile
a piacere nella propria applicazione sia come layout grafico sia come logica. Il framework poggia su 
<a href="https://vuejs.org/" target="_blank">vuejs</a>.
Per la gestione della grafica ci siamo appoggiati a bootstrap4, percio' il framework puo' essere esteso con qualsiasi altra
gestione grafica basata su bootstrap. Ovviamente può essere appoggiato anche su altre framework css a patto di riscrivere
alcune componenti.

## Component

Abbiamo creato un componente principale vue per tutte le componenti presenti nella libreria, si chiama  
[Component](component.md). Va considerato come una classe astratta. L'oggetto c-component
crea un componente vue che è stato definito per permettere una facile simulazione
dell'ereditarietà di un normale linguaggio ad oggetti. Non andrebbe mai istanziato


## Widget
Una componente `Widget` si prende il compito di gestire il singolo dato secondo controlli standard html o plugins 
di varia complessità. Alcuni widget di utilità generale sono stati realizzati nel framework. Si possono creare
widgets secondo le nostre esigenze o estendendo quelli presenti.
[Widgets](widgets.md)


## View
La componente `View` rappresenta una collezione di dati. A questi dati 
vengono associati dei componenti di tipo `Widget` per la loro gestione. Sono state create delle view di utilizzo 
standard ma, anche qui, se ne possono creare di nuove o estendere quelle esistenti per venire incontro alle nostre 
esigenze.
[Views](views.md)

## Template

Il componente `Template` permette di costruire un template html di contorno per l'oggetto `Widget`. 
Viene utilizzato dalle views e permette di poter customizzare i templates per i widgets presenti nella view.
Attraverso il template si puo', per esempio, enfatizzare alcuni campi la dove serve ed evitare di creare viste monotone.
Tutto questo per avere un minimo di variabilità nelle visualizzazioni delle viste, che altrimenti risulterebbero 
troppo vincolate.
[Templates](templates.md)


## Action
Il componente `action` è nato per la gestione delle azioni vogliamo implementare su di una vista. Sono state create
alcune actions standard, ma possono essere definite delle nuove per ogni vista.
[Actions](actions.md)

## Conf
Sono configurazioni iniziali per le istanze delle varie views o wigets. Questo permette di poter variare il comportamento
di un componente e specializzarlo dove serve in modo da potersi discostare dal comportamento di default. 
[Confs](confs.md)

## Route
La classe `Route` incapsula l'interazione con il server sia per il recupero, sia per la spedizione 
dei dati. In genere viene utilizzata da una view e dalle azioni ed è possibile parametrizzarla secondo specifiche
regole.
[Routes](routes.md)


## Server
Classe che rappresenta un wrapper delle chiamate ajax di jquery, con alcune estensioni.
[Server](server.md)

## CrudApp
La componente `CrudApp` rappresenta l'oggetto per la gestione della pagina e delle sue varie componenti 
javascript.
[App](app.md)


## Dashboard
Le dashboards sono modi di utilizzare combinando più views che interagiscono tra loro. Una dashboard fondamentale 
è stata creata già nella libreria e che serve come esempio ed è la `c-manage`.
[Dashboards](dashboards.md)

