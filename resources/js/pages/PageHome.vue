<template>
    <div>
        <div>
            <img src="img/jumbotron-2.jpg" alt="jumbotron" class="img-fluid" id="jumbotron">
        </div>
        <div class="container">
            <div class="d-flex justify-content-center flex-row mt-5">
                <!-- searchbar -->
                <form class="d-flex justify-content-center form-inline my-2 my-lg-0 w-75">
                    <input v-model="search" class="form-control mr-sm-2 w-50" type="search" placeholder="Scrivi qui.." aria-label="Search" @input="searchInput" @click="displayComponent" @keyup="displayComponent">
                    <router-link :to="{name: 'AdvanceSearch', params: {specializationSelect: mySpecialization} }" id="search-button" class="btn btn-outline-primary my-2 my-sm-0">
                        <img id="search-icon" src="img/BDoctors_lens_search.svg" alt="lens-search">
                    </router-link>
                </form>
                </div>
                <div class="collapse position-absolute top- d-flex justify-content-center" v-if="display" @mouseleave="handleFocusOut">
                    <ul class="card overflow-auto">
                        <li v-for="specialization in specializations" :key="specialization.id" @click="selectSpecialization(specialization)">
                            {{ specialization.name }}
                        </li>
                    </ul>
                </div>
                <!-- schede dottori -->
                <div class="mt-5">
                    <div>
                        <big class="fs-2" style="color: #00334e">
                            MEDICI SPONSORIZZATI
                        </big>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-5 my-5">
                        <!-- card singolo dottore -->
                        <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor"/>
                    </div>
                    <div class="mt-5">
                        <big class="fs-2" style="color: #00334e">
                            PERCHÉ SCEGLIERCI
                        </big>
                    </div>
                </div>
            </div>
        </div>
  </template>

  <script>
  import CardDoctor from '../components/CardDoctor.vue'
    export default {
      name: 'Home',
      data() {
        return {
          search: "",
          mySpecialization: null,
          doctors: [],
          specializations: [],
          display: false
        }
      },
      components: {
          CardDoctor,
      },
      created() {
        axios.get('/api/doctors')
          .then(res => {
              if (res.data.success) {
                this.doctors = res.data.result;
              }
            });
      },
      methods: {
        searchInput() {
          if(this.search != ''){
              axios.get('/api/search/specialization?specialization=' + this.search)
          .then(res => {
            if (res.data.success) {
              this.specializations = res.data.result;
              console.log(this.specializations);
            }
          });
          } else {
              this.specializations = [];
          }
        },
        selectSpecialization(specialization) {
          this.mySpecialization = specialization.id;
          this.search = specialization.name;
        },
        displayComponent() {
            this.display = true;
          },
          handleFocusOut() {
            this.display = false;
          }
      }
    }
  </script>

  <style lang="scss" scoped>
    #jumbotron {
        min-width: 100%;
        min-height: 150px;
        width: 20vw;
        height: 30vw;
        object-fit: cover;
        object-position: center;
    }

    #search-button {
        width: 100px;
    }

    #search-icon {
        max-width: 20px;
    }

    li {
        list-style-type: none;
    }

    li:hover {
      background-color: aquamarine;
    }
  </style>
