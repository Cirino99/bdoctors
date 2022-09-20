<template>
    <div class="">
        <div class="container">
            <div class="d-flex flex-column justify-content-center">
                <div class="col-12 m-2 p-2">
                    <div class="card w-100 m-auto">
                        <div class="card-header">
                            <h4>Filtra per:</h4>
                        </div>
                        <!-- searchbar -->
                        <form class="d-flex justify-content-center form-inline my-2 my-lg-0 w-75">
                            <input v-model="search_spec" class="form-control mr-sm-2 w-50" type="search_spec"
                                placeholder="Scrivi qui.." aria-label="Search_spec" @input="searchInput"
                                @click="displayComponent" @keyup="displayComponent">
                            <router-link
                                :to="{name: 'AdvanceSearch', params: {specializationSelect: mySpecialization} }"
                                id="search-button" class="btn btn-outline-primary my-2 my-sm-0">
                                <img id="search-icon" src="img/BDoctors_lens_search.svg" alt="lens-search">
                            </router-link>
                        </form>

                        <div class="collapse position-absolute top- d-flex justify-content-center" v-if="display"
                            @mouseleave="handleFocusOut">
                            <ul class="card overflow-auto">
                                <li v-for="specialization in specializations" :key="specialization.id"
                                    @click="selectSpecialization(specialization)">
                                    {{ specialization.name }}
                                </li>
                            </ul>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Città:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                                    <input v-model="search" @keyup.enter="searchDoctor"
                                        class="form-control mr-sm-2 rounded-3 w-50 me-2" type="search"
                                        placeholder="Scrivi qui.." aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 m my-sm-0 rounded-3"
                                        type="submit">Filtra</button>
                                </form>
                            </li>
                            <!-- <li class="list-group-item d-flex flex-column flex-wrap flex-md-row gap-2">
                                <strong>Specializzazione:</strong><br>
                                <div v-for="specialization in specializations" :key="specialization.id"
                                    class="form-check">
                                    <input class="form-check-input" type="radio" name="specialization"
                                        id="flexRadioDefault1" :checked=" specializationSelect === specialization.id"
                                        @click="changeSpecialization(specialization.id)">
                                    <label class="form-check-label" for="specialization">
                                        {{ specialization.name }}
                                    </label>
                                </div>
                            </li> -->

                            <li class="list-group-item">
                                <strong>Media Voto:</strong>
                                <span v-for="item in 5" :key="item">
                                    <input class="form-check-input" type="radio" name="vote" id="flexRadioDefault1"
                                        :checked="vote === item" @click="changeVote(item)">
                                    <label class="form-check-label" for="vote">
                                        {{item}}
                                    </label>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Numero Recensioni:</strong>
                                <span v-for="item in 4" :key="item">
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
                <div class="d-flex flex-wrap justify-content-evenly col-12">
                    <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor" />
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
        specializationSelect: Number,
    },
    components: {
        CardDoctor,
    },
    data() {
        return {
            doctors: [],
            specializations: [],
            mySpecialization: null,
            search: '',
            search_spec: '',
            vote: 0,
            review: 0,
            display: false
        }
    },
    created() {
        axios.get('/api/search/specialization?specialization=')
            .then(res => {
                if (res.data.success) {
                    this.specializations = res.data.result;
                }
            });
        this.searchDoctor();
    },
    methods: {
        searchDoctor() {
            axios.get('api/search?specialization=' + this.specializationSelect + '&city=all&reviews= ' + this.review + '  &vote=' + this.vote)
                .then(res => {
                    if (res.data.success) {
                        this.doctors = res.data.result;
                    }
                })
        },
        changeSpecialization(id) {
            this.specializationSelect = id;
            this.searchDoctor();
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
            if (this.search_spec != '') {
                axios.get('/api/search/specialization?specialization=' + this.search_spec)
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
            this.mySpecialization = specialization;
            this.search_spec = specialization.name;
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

// .card {
//     width: 60vw;
//     color: $primary;
// }

.form-check {
        display: inline-block;
    }

    #search-button {
        width: 100px;
    }

    #search-icon {
        max-width: 20px;
    }
</style>