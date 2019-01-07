# Server

Classe per le comunicazioni ajax con il backend. E' un wrapper delle chiamate jQuery


### Proprietà

- `static subdomain` : null
proprietà che permette di avere una base comune in tutti gli url codificati dentro
javascript. Esempio se il nostro sito si trova sotto una sottodominio o cartella
http://dominio.it/sottodominio  settiamo il subdomain=sottodominio. Da questo momento in poi
tutte le chiamate avranno url che inizierà con *sottodominio*
  

### Metodi

- `static getUrl(url)`
Ritorna l'url reale combinato con il subdomain.

- `static get(url, params, callback)`
Esegue una chiamata ajax al server in GET.
    - @param url : url da richiamare
    - @param params : parametri che vengono passati in get.
    - @param callback : funzione che verrà richiamata passando come parametro il risultato ricevuto dal
    server

- `static post(url, params, callback)`
Esegue una chiamata ajax al server in POST.
    - @param url : url da richiamare
    - @param params : parametri che vengono passati in pos.
    - @param callback : funzione che verrà richiamata passando come parametro il risultato ricevuto dal
    server

- `static route(route,callback)`
Esegue una chiamata ajax al server utilizzando l'oggetto route.
    - @param route : Oggetto route che incapsula la chiamata
    - @param callback : funzione che verrà richiamata passando come parametro il risultato ricevuto dal
    server
