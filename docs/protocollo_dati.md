#Protocollo dati

La classe protocollo serve per mediare tra la struttura dati che arriva dal server con la struttura interna delle views.
In questo modo, se dovessero cambiare le strutture dati di uscita di un server, implementando il protocollo opportuno,
l'applicazione puo' continuare a funzionare.
E' stato implementato un protocollo di base, per una risposta tipica da parte di un backend. In caso il nostro backend
rispondesse con un json diverso, si devono implementare nuovi protocolli di trasformazione.

Esiste la classe base astratta `Protocol` che definisce due metodi:
- `getData()` : ritorna tutte le proprietà della classe
- `jsonToData(json)' : dato un json applica la politica di trasformazione per le strutture interne della view.

I protocolli attuali sono di due tipi. 
- `ProtocolRecord`: per la gestione delle view di un singolo record
- `ProtocolList` : per la gestione delle view list che gestiscono la lista di records.

##ProtocolRecord
Questo protocollo si aspetta una json fatto in questo modo.

```javascript
{
    error : 0, // 0 o 1. indica la presenza di errori nella richiesta 
    msg : "", // messaggio di errore o di success 
    result : {
        field1 : value // nome campo : valore campo 
        // ... ecc
    },
    metadata : {
        fields : {
            field1 : { // array associativo degli eventuali metadati 
                options : {}, // vettore di valori di dominio, per esempio nelle select,
                options_order : [] //  vettore ordinamento delle options.
                
            } 
        }
        relations : { // vettore relazioni presenti nel modello dati
            relazione1 : {
                fields : {},  // vettore dei campi della relazione 
                // altre informazioni che potete usare
            }   
        }       
    }
}
```


##ProtocolList

```javascript
{
    error : 0, // 0 o 1. indica la presenza di errori nella richiesta 
    msg : "", // messaggio di errore o di success 
    result : {
        current_page : 1,   // pagina corrente
        from : 1,           // numero partenza del primo elemento
        last_page : 10,     // ultima pagina
        pagination_steps : { // configurazione nel numero di elementi per pagina
            5 : 5,
            10 : 10,
            25 : 25,
            50 : 50
        },
        per_page : 10,      // numero elementi per pagina selezionato
        to : 10,            // numero finale dell'ultimo elemento
        total : 100,        // numero elementi totali
        data : [            // vettore di array associativi dei valori 
            {
                field1 : value  // valore campo 
            } 
            //,{
            // ... ecc
            // }
        ],
        
    },
    metadata : {
        fields : {
            field1 : { // array associativo degli eventuali metadati 
                options : {}, // vettore di valori di dominio, per esempio nelle select,
                options_order : [] //  vettore ordinamento delle options.
                
            } 
        }
        relations : { // vettore relazioni presenti nel modello dati
            relazione1 : {
                fields : {},  // vettore dei campi della relazione 
                // altre informazioni che potete usare
            }   
        },
        order : {  // ordinamento della lista, se presente
            direction : "ASC o DESC",
            field : 'nomecampo'
        }             
    }
}
```

##POST di un record in modifica

L'invio dei dati in post viene inviato attraverso il post normale di una form html.
esempio di dati inviati al backend da una view in modifica

```rest
_method: PUT  // variabile speciale per simulare l'azione put REST  
field1 : value  
field2 : value  
// in caso di relazioni esterne ci saranno   
relazione1-field1[] : value
relazione1-field2[] : value

```


##POST di un record in inserimento
Questo è un esempio di cosa invia la form di una view in inserimento al server, rispetto alla modifica cambia
il valore del campo _method,

```rest
_method: POST  // variabile speciale per simulare l'azione inserimento REST  
field1 : value  
field2 : value  
// in caso di relazioni esterne ci saranno   
relazione1-field1[] : value
relazione1-field2[] : value

```

## DELETE di un record

