<template>
  <div class="container mt-5">
        <div class="d-flex justify-content-between mb-5">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <ul class="d-flex flex-column gap-2">
                    <li>
                        <b class="fst-italic">Nome: </b> {{ showProfile.name }}
                    </li>
                    <li>
                        <b class="fst-italic">Cognome: </b> {{ showProfile.lastname }}
                    </li>
                    <li>
                        <b class="fst-italic">Email: </b> {{ showProfile.email }}
                    </li>
                    <li>
                        <b class="fst-italic">Via: </b> {{ showProfile.address }}
                    </li>
                    <li>
                        <b class="fst-italic">Numero di telefono: </b> {{ showProfile.phone }}
                    </li>
                    <li>
                        <b class="fst-italic">Città: </b> {{ showProfile.city }}
                    </li>
                    <li>
                        <b class="fst-italic">CAP: </b> {{ showProfile.postal_code }}
                    </li>
                    <li>
                        <b class="fst-italic">Specializzazione: </b>
                        <span v-for="specialization in showProfile.specializations" :key="specialization.id">
                            {{ specialization.name }}
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-sm-4 col-md-4 col-lg-4">
                <img class="img-fluid img-thumbnail rounded-circle" :src="showProfile.photo" :alt="showProfile.name">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-secondary">Contatta</button>
            <button class="btn btn-success">Scrivi una recensione</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PageShow',
    data() {
        return {
            showProfile: []
        }
    },
    created() {
        axios.get('/api/doctors/2')
            .then(res =>{
                if (res.data.success) {
                    this.showProfile = res.data.result
                    console.log(this.showProfile);
                }
            })
    }
}
</script>

<style lang="scss" scoped>
    li {
        list-style-type: none;
    }

    img {
        min-width: 150px;
        min-height: 150px;
        width: 30vw;
        height: 30vw;
        object-fit: cover;
        object-position: center;
    }
</style>
