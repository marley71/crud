# Server

Classe per le comunicazioni ajax con il backend


##Proprietà

###subdomain
proprietà che permette di avere una base comune in tutti gli url codificati dentro
javascript. E' il prefisso.  Esempio se il nostro sito si trova sotto una sottodominio
http://dominio.it/sottodominio  settiamo il subdomain=sottodominio
  

##Metodi

###static getUrl(url) 
Ritorna l'url reale combinato con il subdomain.

###static get(url, params, callback)
Esegue una chiamata ajax al server in GET con i parametri *params* e ritorna il
risultato json chiamando la *callback*

###static post(url, params, callback)
Esegue una chiamata ajax al server in POST con i parametri *params* e ritorna il
risultato json chiamando la *callback*

###static route(route,callback)
Esegue una chiamata ajax al server utilizzando l'oggetto *route* passato e ritorna
il risultato chiamando la *callback*