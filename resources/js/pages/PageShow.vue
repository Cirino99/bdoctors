<template>
  <div class="container mt-5">
        <div class="d-flex justify-content-between flex-wrap mb-5">
            <!-- lista info profilo -->
            <ul class="col-12 col-sm-12 col-md-6 col-lg-6 d-flex flex-column justify-content-center gap-2 order-2">
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
                    <span v-for="specialization in showProfile.specializations" :key="specialization.id"
                    class="badge bg-warning mx-1">
                        {{ specialization.name }}
                    </span>
                </li>
            </ul>
            <!-- foto profilo -->
            <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-center order-md-2">
                <img class="img-fluid img-thumbnail rounded-circle mb-4" :src="showProfile.photo" :alt="showProfile.name">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-secondary">Prenota</button>
            <button class="btn" style="background: #23A3B3; color: #fff">Scrivi una recensione</button>
        </div>
        <!-- campo per la recensione temporaneo TODO: da sistemare -->
        <div class="form-floating my-4">
            <textarea class="form-control" placeholder="Lascia una recensione" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2" style="color: #cecece">Digita qui..</label>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PageShow',
    props: {
        id: Number,
    },
    data() {
        return {
            showProfile: []
        }
    },
    created() {
        axios.get('/api/doctors/' + this.id)
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

        b {
            color: #008ecf;
        }
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
