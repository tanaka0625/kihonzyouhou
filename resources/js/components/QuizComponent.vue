<template>
    <div class="mt-1">
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
                        {{ category.category }}<input type="checkbox" name="category_checkbox" :value="category.id" v-model="selected_category_ids">
                    </label>
                </div>
            </div>
        

            <div>
                <h3>中機能</h3>
                <div v-for="sub_category in sub_categories" :key="sub_category.id">
                    <label>
                        {{ sub_category.sub_category }}<input type="checkbox" name="sub_category_checkbox" :value="sub_category.id" v-model="selected_sub_category_ids">
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
                word: "単語",
                text: "解説",
                category: "",
                sub_category: "",
                is_visible_text: false,
                is_visible_quiz: false,
                selected_category_ids: [],
                selected_sub_category_ids: [],
                category_ckbox_status: false,
                sub_category_ckbox_status: false
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
            words: function(newVal) {
                this.words = newVal;
            },
            selected_category_ids: function(newVal, oldVal) {
                if(this.category_ckbox_status){

                    // 無限ループ対策　selected_sub_category_idsが動かないように
                    this.sub_category_ckbox_status = false;

                    if(newVal.length < oldVal.length){
                        // 大機能のチェックを外した場合

                        // 差分抽出
                        let difference = [];
                        difference = oldVal.filter(category_id=> newVal.indexOf(category_id) == -1);

                        // 差分に紐づく中機能を取得
                        let deleted_sub_categories;
                        deleted_sub_categories = this.sub_categories.filter(sub_category => sub_category.category_id === difference[0]);
                        let deleted_sub_category_ids = deleted_sub_categories.map(function(value) {
                            return value["id"];
                        });

                        // 差分に紐づく中機能をselected_sub_category_idsから削除
                        let new_sub_category_ids;
                        new_sub_category_ids = this.selected_sub_category_ids.filter(function(sub_category_id){
                            return deleted_sub_category_ids.indexOf(sub_category_id) == -1;
                        },deleted_sub_category_ids);

                        this.selected_sub_category_ids = new_sub_category_ids;
                        // console.log(this.selected_sub_category_ids);
                        // console.log(new_sub_category_ids);
                        console.log(deleted_sub_category_ids);

                    }else{
                        // 大機能にチェックを追加した場合

                        // 差分抽出
                        let difference = [];
                        difference = newVal.filter(category_id=> oldVal.indexOf(category_id) == -1);

                        // 差分に紐づく中機能を取得
                        let added_sub_categories;
                        added_sub_categories = this.sub_categories.filter(sub_category => sub_category.category_id === difference[0]);

                        // 差分に紐づく中機能をselected_sub_category_idsに追加
                        for(let i=0; i<added_sub_categories.length; i++){
                            this.selected_sub_category_ids.push(added_sub_categories[i].id);
                        }
                        let array = Array.from(new Set(this.selected_sub_category_ids));
                        this.selected_sub_category_ids = array;

                    }
                }else{
                    this.category_ckbox_status = true;

                }

 
            },
            selected_sub_category_ids: function(newVal, oldVal) {
                if(this.sub_category_ckbox_status){

                    // 無限ループ対策　selected_sub_category_idsが動かないように
                    this.category_ckbox_status = false;

                    let array=[];
                    for(let i=0; i<newVal.length; i++){
                    
                        let result;
                        result = this.sub_categories.find(function(sub_category){
                            return newVal[i] === sub_category.id;
                        });
                        array[i] = result.category_id;
                    };
                    let array2 = Array.from(new Set(array));
                    this.selected_category_ids = array2;
                }else{
                    this.sub_category_ckbox_status = true;

                }
 
            },

        },

        methods: {

            ask: function () {
                // 出題
                let array = {};
 
                array = this.words.filter(function(word){
                    if(this.includes(word.sub_category_id)) return word;
                },this.selected_sub_category_ids);

                let randnum = Math.floor( Math.random() * array.length);
                this.word = array[randnum].word;
                this.text = array[randnum].text;
                this.category = this.categories.find((category) => category.id === array[randnum].category_id);
                this.sub_category = this.sub_categories.find((sub_category) => sub_category.id === array[randnum].sub_category_id);
                this.text = array[randnum].text;
                this.is_visible_text = false;

                // 出題された回数をカウントアップ
                this.$emit("ask", array[randnum].id);
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