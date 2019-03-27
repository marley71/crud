## Trucchi e convenzioni utilizzate nella libreria

Javascript non e' un linguaggio ad oggetti. In questa libreria si è voluto utilizzare
una function javascript chiamata `Class` creata da <a href="http://ejohn.org/" target="_blank">John Resig</a> 
che simula l'ereditarietà e l'overloading dei metodi.
Vediamo in dettaglio il suo utilizzo e trucchi. Nella definizione di queste classi esiste il metodo speciale
`init` che rappresenta il costruttore.

### Definizione di una nuova classe

Questo codice abbiamo creato una classe chiama `A`;

```javascript
var A = Class.extend({
    prop1 : 'prop1 ',
    prop2 : 'prop2 ',
    // costruttore
    init : function(prop1,prop2) {
        this.prop1 = prop1;
        this.prop2 = prop2;
    },
    
    metodo1 : function() {
        console.log("dump delle props " + this.prop1 + this.prop2);
    },
    metodo2 : function(stringa) {
        this.prop1 = stringa;
    }
})
```

Utilizzo della classe. Nel codice sotto, creo un oggetto di tipo A e chiamo i vari metodi

```javascript
var a = new A('prop passata ','bo ');
a.metodo1();
// verrà stampato
// dump delle props prop passata bo
a.metodo2('as');
a.metodo1();
// verrà stampato
// dump delle props as bo
```


### Definizione sottoclasse 

Per definire una sottoclasse che eredita dalla classe A basta scrivere questo codice.

```javascript
var B = A.extend({
    prop3 : 'prop3 ',
    metodo3 : function() {
        console.log(this.prop1 + this.prop2 + this.prop3);
    }
})
```
Utilizzo della classe. 

```javascript
var b = new B('prop1','prop2');
b.metodo3();
// verrà stampato
//prop1 prop2 prop3
```

### Overloading dei metodi

supponiamo che vogliamo ridefinire un metodo della nostra classe `A`

```javascript
var C = A.extend({
    metodo1 : function() {
        this.prop1 += ' concatenata ';
        this._super(); // richiamo il metodo1 della classe padre
    }
})
```

Utilizzo della classe

```javascript
var c = new C('prop1 ', 'prop2 ');
c.metodo1();
// verrà stampato
//prop1 prop2  concatenata 

```



