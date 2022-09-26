<template>
    <div class="min-vh-100">
        <div class="container my-5">
            <div class="d-flex flex-column justify-content-center">
                <div class="col-12 mb-4">
                    <div class="card w-100 m-auto" style="border-color: #007fbd">
                        <div class="card-header bg-gradient text-light" style="background: #007fbd; border-color: #007fbd">
                            <h5 class="m-auto">Filtra per:</h5>
                        </div>
                        <!-- searchbar -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" style="border-color: #007fbd"><strong>Specializzazioni:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                                    <input v-model="specializationSelect.name" class="form-control mr-sm-2 w-50 me-2" type="search_spec"
                                        placeholder="Scrivi qui.." aria-label="Search_spec" @input="searchInput"
                                        @click="displayComponent" @keyup="displayComponent">
                                    <button class="btn btn-outline-secondary my-2 m my-sm-0 rounded-3" type="button" @click="searchDoctor()">Filtra</button>
                                </form>

                                <div class="collapse position-absolute d-flex my-collapse" v-if="display"
                                    @mouseleave="handleFocusOut">
                                    <ul class="card overflow-auto my-overflow">
                                        <li v-for="specializationLi in specializations" :key="specializationLi.id"
                                            @click="selectSpecialization(specializationLi)">
                                            {{ specializationLi.name }}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item" style="border-color: #007fbd"><strong>Città:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                                    <input v-model="search" @keyup.enter="searchDoctor"
                                        class="form-control mr-sm-2 rounded-3 w-50 me-2" type="search"
                                        placeholder="Scrivi qui.." aria-label="Search">
                                    <button class="btn btn-outline-secondary my-2 m my-sm-0 rounded-3"
                                        type="submit">Filtra</button>
                                </form>
                            </li>
                            <li class="list-group-item" style="border-color: #007fbd">
                                <strong>Media Voto:</strong>
                                <span v-for="item in 5" :key="item" class="mx-1">
                                    <input class="form-check-input" type="radio" name="vote" id="flexRadioDefault1"
                                        :checked="vote === item" @click="changeVote(item)">
                                    <label class="form-check-label" for="vote">
                                        {{item}}
                                    </label>
                                </span>
                            </li>
                            <li class="list-group-item" style="border-color: #007fbd">
                                <strong>Numero Recensioni:</strong>
                                <span v-for="item in 4" :key="item" class="mx-1">
                                    <input class="form-check-input" type="radio" name="review" id="flexRadioDefault1"
                                        :checked="review === item" @click="changeReview(item)">
                                    <label class="form-check-label" for="review">
                                        {{item}}
                                    </label>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div v-if="doctors_sponsorship !== ''">
                    <h2>Scelti da noi:</h2>
                    <div class="d-flex flex-wrap my-4">
                        <CardDoctor v-for="(doctor, index) in doctors_sponsorship" :key="index" :doctor="doctor" class="m-2"/>
                    </div>
                </div>
                <div v-if="doctors !== ''">
                    <h2>Tutti i medici:</h2>
                    <div class="d-flex flex-wrap my-4">
                        <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor" class="m-2"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CardDoctor from '../components/CardDoctor.vue'
export default {
    name: 'PageAdvanceSearch',
    props: {
        specialization: Number
    },
    components: {
        CardDoctor,
    },
    data() {
        return {
            doctors: '',
            doctors_sponsorship: '',
            specializations: [],
            specializationSelect: {
                'name' : '',
                'id' : null
            },
            search: '',
            vote: 0,
            review: 0,
            display: false
        }
    },
    created() {
        console.log(this.specialization);
        this.specializationSelect.id = this.specialization;
        console.log( this.specializationSelect);
        axios.get('/api/search/specialization/id?id=' + this.specialization)
                .then(res => {
                    if (res.data.success) {
                        this.specializationSelect.name = res.data.result.name;
                    }
                });
        this.searchDoctor();
    },
    methods: {
        searchDoctor() {
            if(this.specializationSelect.id != ''){
                axios.get('/api/search?specialization=' + this.specializationSelect.id + '&city=all&reviews=' + this.review + '&vote=' + this.vote)
                .then(res => {
                    console.log(res.data);
                    if (res.data.success) {
                        console.log('mariooo');
                        this.doctors = res.data.result[0];
                        this.doctors_sponsorship = res.data.result[1];
                    }
                })
            }
        },
        changeVote(id) {
            this.vote = id;
            this.searchDoctor();
        },
        changeReview(id) {
            this.review = id;
            this.searchDoctor();
        },

        searchInput() {
            if (this.specializationSelect.name != '') {
                axios.get('/api/search/specialization?specialization=' + this.specializationSelect.name)
                    .then(res => {
                        if (res.data.success) {
                            this.specializations = res.data.result;
                        }
                    });
            } else {
                this.specializations = [];
            }
        },
        selectSpecialization(specialization) {
          this.specializationSelect.name = specialization.name;
          this.specializationSelect.id = specialization.id;
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
@import "../../sass/bdoctor-palette.scss";

.form-check {
        display: inline-block;
    }

    #search-button {
        width: 100px;
    }

    #search-icon {
        max-width: 20px;
    }

    .my-collapse{
        z-index: 500;
        width: 47%;

        ul{
            padding: 0;
        }

        li{
            list-style-type:none;
            padding-left: 5px;
        }

        li:hover{
            background-color: $bluelight;
        }

        .my-overflow{
            width: 100%;
        }
    }
</style>
