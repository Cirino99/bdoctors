<template>
    <div class="min-vh-100">
        <div id="sez-nome" class="bg-blu-chiaro text-white d-flex justify-content-center align-items-center">
            <h2> Dr. {{ showProfile.name }} {{ showProfile.lastname }}</h2>
        </div>
        <div class="container mt-5">
            <div class="d-flex justify-content-start flex-wrap mb-5">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center flex-column">
                    <!-- foto profilo -->
                    <img id="user-img" class="img-fluid img-thumbnail rounded-circle mb-4" :src="showProfile.photo" :alt="showProfile.name">
                    <ul class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex flex-column justify-content-center gap-2 order-2">
                        <li class="col-12">
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
                            class="bg-label badge mx-1 text-dark">
                                {{ specialization.name }}
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- lista info profilo -->
                <div class="fst-italic col-12 col-sm-12 col-md-6 col-lg-8">
                    <div>
                        <h2>Il mio curriculum</h2>
                        <p>{{ showProfile.cv }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-secondary rounded-pill" @click="displayMessage">Contatta</button>
                <button class="btn btn-bg-blu-chiaro rounded-pill text-light" @click="displayReview">Scrivi una recensione</button>
            </div>
            <!-- alert -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Bootstrap</strong>
                        <small>11 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Hello, world! This is a toast message.
                    </div>
                </div>
            </div>
            <!-- campo recensione -->
            <div class="form-floating my-4" v-show="displayR">
                <!-- voto -->
                <div class="d-flex justify-content-start">
                    <div>
                        <label for="floatingTextarea2">Nome*</label>
                        <input required id="review-nome" class="form-control" type="text" v-model="name" placeholder="Il tuo nome...">
                    </div>
                    <div id="voto">
                        <label for="floatingTextarea2">Voto*</label>
                        <input required class="form-control" type="number" v-model="vote" placeholder="voto...">
                    </div>
                </div>

                <!-- recensione  -->
                <div class="mt-4">
                    <label for="floatingTextarea2">Recensione*</label>
                    <textarea class="form-control" placeholder="Lascia una recensione..." id="floatingTextarea2" v-model="text" style="height: 100px"></textarea>
                    <button class="btn mt-1 p-1 px-2 text-light" id="liveToastBtn" style="background: #23A3B3" @click="newReview(showProfile.id)">Invia</button>
                </div>
            </div>
            <!-- campo contatta  -->
            <div class="form-floating my-4" v-show="displayM">
                <!-- email -->
                <div class="d-flex justify-content-start">
                    <div>
                        <label for="floatingTextarea2">Email*</label>
                        <input required id="message-email" class="form-control" type="email" v-model="email" placeholder="La tua email...">
                    </div>
                </div>

                <!-- messaggio  -->
                <div class="mt-4">
                    <label for="floatingTextarea2">Messaggio*</label>
                    <textarea required class="form-control" placeholder="Lascia un messaggio..." id="floatingTextarea2" v-model="text" style="height: 100px"></textarea>
                    <label for="floatingTextarea2"></label>
                    <button class="btn mt-1 p-1 px-2 text-light" id="liveToastBtn" style="background: #23A3B3" @click="newMessage(showProfile.id)">Invia</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
// import swal from 'sweetalert';
import Swal from 'sweetalert2';

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
            displayR: false,
            displayM: false,
            prova: false
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
                    this.displayR = false;
                }
                Swal.fire('Recensione inviata');
            }).catch(function (error) {
                console.log(error);
            });
            } else {
                Swal.fire('compila tutti i campi obbligatori');
                return false;
            }
        },

        newMessage($id){
            if(this.email != '' && this.text != ''){
                if (!this.email.includes('@') || !this.email.includes('.')) {
                    Swal.fire('email non corretta');
                    return false;
                } else {
                    axios.post('/api/message', {
                    id: $id,
                    email: this.email ,
                    text: this.text
                })
                .then(res => {
                    if (res.data.success) {
                        this.email = '';
                        this.text = '';
                        this.displayM = false;
                    }
                    Swal.fire('Messaggio inviato');
                }).catch(function (error) {
                    console.log(error);
                })
                }
            } else {
                Swal.fire('compila tutti i campi obbligatori');
                return false;
            }
        },

        displayReview() {
            if (this.displayM = this.displayM) {
                this.displayM = !this.displayM
            }
            this.displayR = !this.displayR
        },

        displayMessage() {
            if (this.displayR = this.displayR) {
                this.displayR = !this.displayR
            }
            this.displayM = !this.displayM
        },

        // hideComponent() {
        //     this.displayR = false;
        //     this.displayM = false;
        // }
    }
}
</script>

<style lang="scss" scoped>

    @import "../../sass/bdoctor-palette.scss";

    #sez-nome {
        height: 15vh;

        h2 {
            text-align: center;
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

    // swal

    .swal-button {
    background-color: #004d73;
    color: white;
    }

    // .swal-button:not([disabled]):hover{
    //     background-color: #00334e;
    // }

    .swal-text {
        background-color: rgb(226, 25, 25);
        padding: 17px;
        border: 1px solid rgb(226, 25, 25);
        display: block;
        margin: 22px;
        text-align: center;
        color: white;
    }

    // colors
    .bg-label {
        background: $bluelight;
    }

    .blu-scuro {
        color: $bluedark;
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
    .btn-bg-blu-chiaro {
        background-color: $bluedark;

        &:hover {
            background: $ultradark
        }
    }
    .bg-blu-chiaro {
        background-color: $bluedark;
    }
    .bg-blu-chiaro2 {
        background-color: #8ce6ff;
    }
    .bg-nero {
        background-color: #2a2d45;
    }

</style>
