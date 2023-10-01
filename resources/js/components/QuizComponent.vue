<template>
    <div>
        <button class="btn btn-dark" v-on:click="show_quiz()">クイズ</button>
        <div v-if="is_visible_quiz">

            <div>
                <div>
                    <h5 v-if="is_visible_text">大機能:{{ category.category }}  中機能:{{ sub_category.sub_category }}</h5>
                </div>

                <div id="word">
                    <h2>
                        {{ word }}
                    </h2>
                </div>

                <div id="text" v-if="is_visible_text">
                    {{ text }}
                </div>
                <div>
                    <button class="btn btn-primary" v-on:click="ask()">
                        出題
                    </button>
                    <button class="btn btn-primary" v-on:click="see_text()">
                        解説
                    </button>
                </div>
            </div>


            <div>
                <h3>大機能</h3>
                <div v-for="category in categories" :key="category.id">
                    <label>
                        {{ category.category }}<input type="checkbox" name="category_checkbox" :value="category.id" v-model="selected_category_ids" v-on:click="test()">
                    </label>
                </div>
            </div>
        

            <div>
                <h3>中機能</h3>
                <div v-for="sub_category in sub_categories" :key="sub_category.id">
                    <label>
                        {{ sub_category.sub_category }}<input type="checkbox" name="sub_category_checkbox" :value="sub_category.id" v-model="selected_sub_category_ids" v-on:click="test()">
                    </label>
                </div>
            </div>

        </div>
    </div>


</template>





<script>

    export default {
        props: {
            categories: {
                type: Array,
                requires: true
            },
            sub_categories: {
                type: Array,
                requires: true
            },
            item: {
                type: Array
            },
            words: {
                type: Array,
                requires: true
            }

        },
        data() {
            return {
                // word: this.ask()
                word: "単語",
                text: "解説",
                category: "",
                sub_category: "",
                is_visible_text: false,
                is_visible_quiz: false,
                selected_category_ids: [],
                selected_sub_category_ids: []
            };
        },
        created: function() {
            let array = [];
            this.categories.forEach(function(category){
                array.push(category.id);
            });
            this.selected_category_ids = array;

            let array2 = [];
            this.sub_categories.forEach(function(sub_category){
                array2.push(sub_category.id);
            });
            this.selected_sub_category_ids = array2;
        },
        watch: {
            selected_category_ids: function(newVal, oldVal) {
                
 
            },
            selected_sub_category_ids: function(newVal, oldVal) {
                
                let array=[];
                for(let i=0; i<newVal.length; i++){
                   
                    let result;
                    result = this.sub_categories.find(function(sub_category){
                        return newVal[i] === sub_category.id;
                    });
                    console.log(result);
                    array[i] = result.category_id;
                };
                let array2 = Array.from(new Set(array));
                this.selected_category_ids = array2;
            },

        },

        // computed: {
        //     selected_sub_category_ids: {
        //         get: function () {
        //             let array2 = [];
        //             this.sub_categories.forEach(function(sub_category){
        //             array2.push(sub_category.id);
        //             });
        //             return array2;
        //         },
        //         set: function (a) {
        //             console.log(this.selected_sub_category_ids);
        //             console.log(a);

        //             // this.selected_sub_category_ids = a;
        //             return a;
        //         }
              
        //     },
        //     selected_category_ids: function() {
        //         let array1 = [];
        //         this.categories.forEach(function(category){
        //             array1.push(category.id);
        //         });
        //         return array1;
        //     },

        // },

        methods: {

            // update_sub_category_ckbox_statuses: function () {
            //     console.log(this.selected_sub_category_ids);
            // },
            test: function () {
                // console.log(this.selected_category_ids);
                // console.log(this.selected_sub_category_ids);
                console.log(1);
            },
            ask: function () {
                // console.log(1);
                // console.log(this.selected_sub_category_ids);
                let array = {};
 
                array = this.words.filter(function(word){
                    if(this.includes(word.sub_category_id)) return word;
                },this.selected_sub_category_ids);
                // console.log(2);
                // console.log(this.selected_sub_category_ids);

                let randnum = Math.floor( Math.random() * array.length);
                // console.log(array);
                this.word = array[randnum].word;
                this.text = array[randnum].text;
                this.category = this.categories.find((category) => category.id === array[randnum].category_id);
                this.sub_category = this.sub_categories.find((sub_category) => sub_category.id === array[randnum].sub_category_id);
                this.text = array[randnum].text;
                this.is_visible_text = false;
            },
            see_text: function () {
                this.is_visible_text = true;
            },
            show_quiz: function () {
                if(this.is_visible_quiz){
                    this.is_visible_quiz = false;
                }else{
                    this.is_visible_quiz = true;
                }
            }
        }
    }

</script>