<template>
    <div>
        <div id="sez-nome" class="bg-blu-chiaro text-white d-flex justify-content-center align-items-center">
            <h2> Dr. {{ showProfile.name }} {{ showProfile.lastname }}</h2>       
        </div>
        <div class="container mt-5">
            <div class="d-flex justify-content-start flex-wrap mb-5">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center flex-column">
                    <!-- foto profilo -->
                    <img id="user-img" class="img-fluid img-thumbnail rounded-circle mb-4" :src="showProfile.photo" :alt="showProfile.name">
                    <ul class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex flex-column justify-content-center gap-2 order-2">
                        <li>
                            <h3>
                                Dr. {{ showProfile.name }} {{ showProfile.lastname }}
                            </h3>
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Email: </b> {{ showProfile.email }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Numero di telefono: </b> {{ showProfile.phone }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Città: </b> {{ showProfile.city }}
                        </li>
                        <li>
                            <b class="fst-italic blu-scuro">Via: </b> {{ showProfile.address }}
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
                    <h4>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita dolorem rerum, tempore quaerat quasi quisquam! Delectus, fuga laboriosam voluptatem quos eveniet blanditiis eum quidem et dolorum eaque earum iure neque!
                    </h4>
                    <div>
                        CV: {{ showProfile.cv }}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-secondary" @click="displayMessage">Prenota</button>
                <button class="btn" style="background: #23A3B3; color: #fff" @click="displayReview">Scrivi una recensione</button>
            </div>
            <!-- campo per la recensione temporaneo TODO: da sistemare -->
            <div class="form-floating my-4" v-if="displayR">
                <!-- voto -->
                <div class="d-flex justify-content-start">
                    <input id="review-nome" class="form-control" type="text" v-model="name" placeholder="Il tuo nome...">
                    <input id="voto" class="form-control" type="number" v-model="vote" placeholder="voto...">
                </div>

                <!-- recensione  -->
                <div class="mt-4">
                    <textarea class="form-control" placeholder="Lascia una recensione..." id="floatingTextarea2" v-model="text" style="height: 100px"></textarea>
                    <label for="floatingTextarea2"></label>
                    <button class="btn mt-4" style="background: #23A3B3; color: #fff" @click="newReview(showProfile.id); hideComponent()">Invia</button>
                </div>
            </div>
            <!-- campo messaggio  -->
            <div class="form-floating my-4" v-if="displayM">
                <!-- email -->
                <div class="d-flex justify-content-start">
                    <input id="message-email" class="form-control" type="text" v-model="email" placeholder="La tua email...">
                </div>

                <!-- messaggio  -->
                <div class="mt-4">
                    <textarea class="form-control" placeholder="Lascia un messaggio..." id="floatingTextarea2" v-model="message" style="height: 100px"></textarea>
                    <label for="floatingTextarea2"></label>
                    <button class="btn mt-4" style="background: #23A3B3; color: #fff" @click="newMessage(showProfile.id); hideComponent()">Invia</button>
                </div>
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
            text: '',
            email: '',
            message: '',
            displayR: false,
            displayM: false
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
        },

        displayReview() {
            this.displayR = true
        },

        displayMessage() {
            this.displayM = true
        },

        hideComponent() {
            this.displayR = false;
        }
    }
}
</script>

<style lang="scss" scoped>

    @import "../../sass/bdoctor-palette.scss";

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
        width: 200px;
        height: 200px;
        object-fit: cover;
        object-position: center;
    }

    #review-nome {
        width: 200px;
    }

    #message-email {
        width: 300px;
    }

    #voto {
        width: 80px;
        margin-left: 20px;
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
