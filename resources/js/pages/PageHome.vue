<template>
  <div class="container">
    <div class="d-flex justify-content-center flex-row mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input v-model="search" class="form-control mr-sm-2 rounded-3" type="search" placeholder="Scrivi qui.." aria-label="Search" @input="searchInput" @click="displayComponent" @keyup="displayComponent">
        <router-link :to="{name: 'AdvanceSearch', params: {specializationSelect: mySpecialization} }" class="btn btn-outline-primary my-2 my-sm-0 w-75 rounded-3">
            <img src="img/BDoctors_lens_search.svg" alt="lens-search">
        </router-link>
      </form>
    </div>
    <div class="d-flex justify-content-center" v-if="display" @mouseleave="handleFocusOut">
        <ul>
            <li v-for="specialization in specializations" :key="specialization.id" @click="selectSpecialization(specialization)">
                {{ specialization.name }}
            </li>
        </ul>
    </div>
    <div class="mt-5">
      <div>
        <big class="fs-2" style="color: #00334e">
            MEDICI SPONSORIZZATI
        </big>
      </div>
      <div class="d-flex justify-content-center my-5">
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
    img {
        max-width: 100px;
        min-height: 10px;
        width: 2vw;
        height: 2vw;
    }

    li:hover {
    background-color: aquamarine;
  }
</style>
