<template>
    <div>
        <div id="sez-nome" class="bg-blu-chiaro text-white d-flex justify-content-center align-items-center">
            <h2>{{ showProfile.name }} {{ showProfile.lastname }}</h2>       
        </div>
        <div class="container mt-5">
            <div class="d-flex flex-row-reverse flex-wrap mb-5">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center order-md-2 flex-column">
                    <!-- foto profilo -->
                    <img id="user-img" class="img-fluid img-thumbnail rounded-circle mb-4" :src="showProfile.photo" :alt="showProfile.name">
                    <ul class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex flex-column justify-content-center gap-2 order-2">
                        <li>
                            <b class="fst-italic blu-scuro">Nome: </b> {{ showProfile.name }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Cognome: </b> {{ showProfile.lastname }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Email: </b> {{ showProfile.email }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Via: </b> {{ showProfile.address }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Numero di telefono: </b> {{ showProfile.phone }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Città: </b> {{ showProfile.city }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">CAP: </b> {{ showProfile.postal_code }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Specializzazione: </b>
                            <span v-for="specialization in showProfile.specializations" :key="specialization.id"
                            class="badge bg-warning mx-1">
                                {{ specialization.name }}
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- lista info profilo -->
                <div class="fst-italic col-12 col-sm-12 col-md-6 col-lg-8">
                    CV: {{ showProfile.cv }}
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-secondary">Prenota</button>
                <button class="btn" style="background: #23A3B3; color: #fff" @click="newReview(showProfile.id)">Scrivi una recensione</button>
            </div>
            <!-- campo per la recensione temporaneo TODO: da sistemare -->
            <div class="form-floating my-4">
                <input type="text" v-model="name">
                <input type="number" v-model="vote">
                <textarea class="form-control" placeholder="Lascia una recensione" id="floatingTextarea2" v-model="text" style="height: 100px"></textarea>
                <label for="floatingTextarea2" style="color: #cecece">Digita qui..</label>
            </div>
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
            showProfile: [],
            name: '',
            vote: '',
            text: ''
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
    },
    methods: {
        newReview($id){
            if(this.name != '' && this.vote != '' &&  this.text != ''){
                axios.post('/api/review', {
                id: $id,
                name: this.name ,
                vote: this.vote,
                text: this.text
            })
            .then(res => {
                if (res.data.success) {
                    this.name = '';
                    this.vote = '';
                    this.text = '';
                }
            }).catch(function (error) {
                console.log(error);
            });
            }
        }
    }
}
</script>

<style lang="scss" scoped>

    #sez-nome {
        height: 10vh;
        h2 {
            margin: 0.5%;
            font-size: 50px;
        }
    }
    li {
        list-style-type: none;
    }
  
    #user-img {
        min-width: 150px;
        min-height: 150px;
        width: 20vw;
        height: 20vw;
        object-fit: cover;
        object-position: center;
    }

    // colors
    .blu-scuro {
        color: #00acff;
    }
    .blu-chiaro {
        color: #00c7ff;
    }
    .blu-chiaro2 {
        color: #8ce6ff;
    }
    .nero {
        color: #2a2d45;
    }
    .bg-blu-scuro {
        background-color: #00acff;
    }
    .bg-blu-chiaro {
        background-color: #00c7ff;
    }
    .bg-blu-chiaro2 {
        background-color: #8ce6ff;
    }
    .bg-nero {
        background-color: #2a2d45;
    }
    
</style>
