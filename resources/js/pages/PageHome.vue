<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <input type="text" id="search-bar">
      <button>CERCA</button>
    </div>

    <div class="mt-5">
      <div>
        <h3>
          MEDICI SPONSORIZZATI
        </h3>
      </div>
      <div class="d-flex justify-content-center">
        <div class="card">
          <div>
            FOTO
          </div>
          <div>
            NOME
          </div>
          <div>
            COGNOME
          </div>
          <div>
            SPECIALIZZAZIONE
          </div>
          <div>
            VALUTAZIONE
          </div>
        </div>
      </div>
      <div class="mt-5">
        <h2>
          PERCHÉ SCEGLIERCI
        </h2>
      </div>
    </div>
  </div>
</template>
  
<script>
  export default {
    name: 'Home',

    created() {
        axios.get('/')
            
    }
  }
</script>
  
<style>
  #search-bar {
    width: 300px;
  }

  .card {
    width: 20%;
  }
</style>