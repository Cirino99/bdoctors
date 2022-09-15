<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <form class="d-flex form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

    <div class="mt-5">
      <div>
        <h3>
          MEDICI SPONSORIZZATI
        </h3>
      </div>
      <div class="d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Nome</h5>
            <h5 class="card-title">Cognome</h5>
            <p class="card-text">Testo</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">SPECIALIZZAZIONE</li>
            <li class="list-group-item">VALUTAZIONE</li>
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">Visualizza</a>
            <a href="#" class="card-link">Contatta</a>
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

    // created() {
    //     axios.get('/api/doctors')      
    // }
  }
</script>
  
<style>
  #search-bar {
    width: 300px;
  }
  .card {
    width: 20%;
  }

  #photo-doctor-home {
    height: 100%;
    width: 100%;
  }
</style>