# Protocollo dati

In questa pagina spiego cosa si aspettano le view come dati da un eventuale server backend. Questi esempi 
sono a titolo di esempio in quanto se noi abbiamo dei server che rispondono con un json strutturalmente diverso
possiamo creare una classe javascript che estenderà la classe principale Protocol dove potete definire il match
tra quello che arriva dal server e quello che si aspetta la libreria.
Le view lavorano con questo protocollo

## GET di un record

```javascript
{
    result : {
        field1 : value // valore campo 
        // ... ecc
    },
    metadata : {
        field1 : {} // array associativo degli eventuali metadati 
    },
    validationRules : { //array assocativo di eventuali regole di validazione javascript
        
    },
    translations : {} // eventuali traduzioni private di labels presenti nella view
}
```


## GET di una lista

```javascript
{
    result : {
        current_page : 1,   // pagina corrente
        from : 1,           // numero partenza del primo elemnto
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
        field1 : {} // array associativo degli eventuali metadati 
    },
    validationRules : { //array assocativo di eventuali regole di validazione javascript
        
    },
    translations : {} // eventuali traduzioni private di labels presenti nella view
}
```

## POST di un record in modifica

esempio di dati inviati al backend da una view in modifica

```rest
_method: PUT  // variabile speciale per simulare l'azione put REST  
field1 : value  
field2 : value  
// in caso di relazioni esterne ci saranno   
id: 1  
stringa: Pariatur itaque commodi voluptatem suscipit quae est.  
intero: 10  
fotos_exists: 1  
attachments_exists: 1  
hasmanytests_exists: 1  
captcha:   
test_hasmanytests_exists: 1  
```


## POST di un record in inserimento

Questo è un esempio di cosa invia la form di una view in inserimento al server
```rest
id:  
stringa: ffadf  
intero: 3  
captcha: 

--- questa sezione rappresenta gli foto che sono in relazione hasmany  
fotos-ext[]: jpg  
fotos-random[]: 154719847888307  
fotos-id[]:   
fotos-status[]: new  
fotos-original_name[]: 1768904457040870023.jpg  
fotos-filename[]: temp_fotos_154719847888307.jpg  
fotos-mimetype[]: image/jpeg  
fotos-nome[]:   
fotos-descrizione[]: 
fotos_exists: 1  
--- fotos_exists e' un campo di controllo per dire che la relazione veniva gestita nella form della view. 
--- serve perche' in caso di eliminazione di tutti gli elementi posso non riuscire a distinguere tra una
--- view che non gestisce la relazione e una view che la gestisce ma l'utente ha cancellato tutti gli elementi

--- questa sezione rappresenta gli attachment che sono in relazione hasmany  ----
attachments-ext[]: pdf  
attachments-random[]: 154719851213896  
attachments-id[]:   
attachments-status[]: new  
attachments-original_name[]: Menu.pdf  
attachments-filename[]: temp_attachments_154719851213896.pdf  
attachments-mimetype[]: application/pdf  
attachments-nome[]:  
attachments-descrizione[]:  
attachments_exists: 1 
--- fine sezione variabili attachment-----   
 
--- relazione esterna hasmany ma senza upload 
relazione3-status[]: new  
relazione3-id[]:   
relazione3_exists: 1  

_method: POST  
```
