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
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Specializzazioni:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                            <input v-model="specializationSelect.name" class="form-control mr-sm-2 w-50" type="search_spec"
                                placeholder="Scrivi qui.." aria-label="Search_spec" @input="searchInput"
                                @click="displayComponent" @keyup="displayComponent">
                            <button class="btn btn-outline-primary my-2 m my-sm-0 rounded-3" type="button" @click="searchDoctor()">Filtra</button>
                        </form>

                        <div class="collapse position-absolute d-flex my-collapse" v-if="display"
                            @mouseleave="handleFocusOut">
                            <ul class="card overflow-auto my-overflow">
                                <li v-for="specialization in specializations" :key="specialization.id"
                                    @click="selectSpecialization(specialization)">
                                    {{ specialization.name }}
                                </li>
                            </ul>
                        </div>
                            </li>
                            <li class="list-group-item"><strong>Città:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                                    <input v-model="search" @keyup.enter="searchDoctor"
                                        class="form-control mr-sm-2 rounded-3 w-50 me-2" type="search"
                                        placeholder="Scrivi qui.." aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 m my-sm-0 rounded-3"
                                        type="submit">Filtra</button>
                                </form>
                            </li>
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
                <div class="d-flex flex-wrap justify-content-start">
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
        specializationSelect: {
            default: function(){
                return {
                'name' : '',
                'id' : ''
            }},
            type: Object
        },
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
            vote: 0,
            review: 0,
            display: false
        }
    },
    created() {
        this.searchDoctor();
    },
    methods: {
        searchDoctor() {
            if(this.specializationSelect.name != ''){
                axios.get('api/search?specialization=' + this.specializationSelect.id + '&city=all&reviews= ' + this.review + '  &vote=' + this.vote)
                .then(res => {
                    if (res.data.success) {
                        this.doctors = res.data.result;
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
                            console.log(this.specializations);
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