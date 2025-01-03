(function(){

    const ctx = document.getElementById('myChart').getContext('2d');

    obtenerDatos()
    async function obtenerDatos() {
        const url = '/api/regalos'
        const respuesta = await fetch(url)
        const resultado = await respuesta.json()

        console.log(resultado);
        
    }
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Primer Valor', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
              label: '',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: [
                  '#ea580c',
                  '#84cc16',
                  '#22d3ee',
                  '#a855f7',
                  '#ef4444',
                  '#14b8a6',
                  '#db2777',
                  '#e11d48',
                  '#7e22ce'
              ]
          }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          legend: {
              display: false
          }
        }
      }
    });

})();