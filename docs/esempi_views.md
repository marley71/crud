#View che lavorano con liste di dati 

Per avere un comporamento simil ad un linguaggio ad oggetti..
Ogni volta che si ridefinisce un metodo della Component è
possibile chiamare il metodo padre attaverso la convenzione this.super

## - Lista con dati json

```javascript
// definisco i miei dati
var mydata = {
    value :  [
        {
            text : 100,
            intero : '1',
            stringa : 'prova'
        },
        {
            text : 2,
            intero : '1',
            stringa : 'fprova2'
        },
    ]
}

// creo una configurazione per la view lista
var myList = new ConfList({
    fields : ['stringa','intero','text'], // campi che voglio visualizzare
    container : '#test_container1',  // container dove verrà disegnata la view
    modelName : 'dummy', // modelname dummy, uso sempre questo per i dati dinamici
    routeName : null, // nessuna route verso il server i dati ci sono già
    pagination : false, // se voglio o no il navigatore per la paginazione
    actions : [], //azioni che si possono fare sui singoli record  o lista
    data : mydata // dati della lista
});

// aggiungo la lista
var vkey = app.addView(myList);
// la renderizzo 
app.renderView(vkey);

```

<a href="http://www.pierpaolociullo.it/example?f=view_list" target="_blank"> Vai </a>

## - Lista con dati json con intestazioni header custom

```javascript
// definisco i miei dati
var mydata = {
    value :  [
        {
            text : 100,
            intero : '1',
            stringa : 'prova'
        },
        {
            text : 2,
            intero : '1',
            stringa : 'fprova2'
        },
    ]
}

// creo una configurazione per la view lista
var myList = new ConfList({
    fields : ['stringa','intero','text'], // campi che voglio visualizzare
    container : '#test_container1',  // container dove verrà disegnata la view
    modelName : 'dummy', // modelname dummy, uso sempre questo per i dati dinamici
    routeName : null, // nessuna route verso il server, i dati ci sono già
    pagination : false, // se voglio o no il navigatore per la paginazione
    actions : [], //azioni che si possono fare sui singoli record  o lista
    data : mydata, // dati della lista
    labels : {
        'dummy.stringa.label' : 'campo stringa'
    }
});

// aggiungo la lista
var vkey = app.addView(myList);
// la renderizzo 
app.renderView(vkey);
```

##Views che lavorano con singolo record

## - Vista in modalità edit con azione ActionSave ridefinita

```javascript

// definisco i miei dati che propongo nella view. Un solo record
var mydata =  {
    value : {  // valori del mio ipotetico modello dati
        text : "testo ",
        intero : 1,
        stringa : 'prova'
    },
    metadata : {  // metadata dei miei valori, in questo caso il campo intero può avere solo 2 valori
        intero : {
            domainValues : {
                0 : 'Zero',
                1 : 'Uno'
            }
        }
    }
}
// definisco la configurazione della mia vista
var myList = new ConfInsert({
    fields : ['stringa','intero','text'],  //campi che voglio visualizzare
    container : '#test_container1',        // container dove verrà disegnata la vista
    modelName : 'dummy',                    // model name per dati dinamici
    routeName : null,                       // nessuna route verso il server, i dati ci sono già
    actions : ['ActionSave','ActionMia'],   //azione save presente nella libreria
    data : mydata,
    fields_config : {                       // configurazione campi
        intero : {                          // dico che il campo intero e' una select
            type : 'select'
        },
        text : {
            type : 'textarea'
        }
    },
    custom_actions : {   // ridefiniamo l'azione ActionSave presente in libreria per inserire il nostro comportamento
        ActionSave : ActionSave.extend({
            execute : function () {
                alert(JSON.stringify(this.view.getFormData()))
            }
        })  
    },
    autorender : true, // dico che la view la voglio renderizzare appena l'aggiungo
});
app.addView(myList);

```

## - Vista in modalità edit con azione custom e template custom

```javascript

// definisco i miei dati che propongo nella view. Un solo record
var mydata =  {
    value : {  // valori del mio ipotetico modello dati
        text : "testo ",
        intero : 1,
        stringa : 'prova'
    },
    metadata : {  // metadata dei miei valori, in questo caso il campo intero può avere solo 2 valori
        intero : {
            domainValues : {
                0 : 'Zero',
                1 : 'Uno'
            }
        }
    }
}
// definisco la configurazione della mia vista
var myList = new ConfInsert({
    fields : ['stringa','intero','text'],  //campi che voglio visualizzare
    container : '#test_container1',        // container dove verrà disegnata la vista
    modelName : 'dummy',                    // model name per dati dinamici
    routeName : null,                       // nessuna route verso il server, i dati ci sono già
    actions : ['ActionMia'],               //azione save presente nella libreria
    data : mydata,
    fields_config : {                       // configurazione campi
        intero : {                          // dico che il campo intero e' una select
            type : 'select'
        },
        text : {
            type : 'textarea'
        }
    },
    custom_actions : {
        ActionMia : RecordAction.extend({
            text : 'mia',
            title : 'azione custom',
            execute : function () {
                alert(JSON.stringify(this.view.getFormData()))
            }
        })  
    },
    labels : {
        'app.mialabel' : 'Questa e\' una vista con template personale rispetto a quello standard',  
    },
    template : function () {
        return `
        <div class="well" data-edit-main>
            <div data-alert class="alert alert-success hide"></div>
            <div data-label="app.mialabel"></div>
            <form name="data_form" class="model-edit">
                <div data-hidden_fields>
                    <!-- qui dentro verrano disegnati i renders speciali hidden -->
                </div>
                <div data-view_elements>
                    <!-- qui dentro verrano disegnati i renders -->
                </div>
                <div data-view_action >
                    <!-- qui dentro verrano disegnate le azioni definite -->
                </div>
            </form>
        </div>
    `
    },
    autorender : true, // dico che la view la voglio renderizzare appena l'aggiungo
});
app.addView(myList);

```