## Utilizzo libreria con html

La libreria è stata pensata per essere utilizzata senza scrivere javascript.
Per fare questo basta aggiungere l'opzione autoparse = true nella configurazione
dell'oggetto App.

Creiamo la nostra app con questa configurazione.

```javascript
    app = new App();
    app.init({
        autoparse : true,

    });
```

Da questo momento, la libreria ogni volta che aggiungiamo un html alla pagina controlla
che non ci siamo un attributo crud-parse. Se lo trova esegue il parse del contenuto
e istanzia tutte le componenti riconosciute.


