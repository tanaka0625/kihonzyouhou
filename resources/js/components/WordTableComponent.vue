<template>
    <div>
        <table class="table table-bordered">
                <tr><th>id</th><th>単語</th><th>意味</th><th>大分類</th><th>中分類</th><th>出題回数</th><th>分からなかった回数</th></tr>
                <tr v-for="word in words" :key="word.id" :value="word.id">
                    <td>
                        {{word.id}}
                        <button class="btn btn-primary" type="button" v-on:click="show_edit_form(word.id)">編集</button>
                        <form-edit-word-component :word="word" :category="find_category(word.category_id)" :sub_category="find_sub_category(word.sub_category_id)" :edit_form_word_id="id" :categories="categories" :sub_categories="sub_categories"></form-edit-word-component>
                    </td>
                    <td>{{word.word}}</td>
                    <td>{{word.text}}</td>
                    <td>{{find_category(word.category_id).category}}</td>
                    <td>{{find_sub_category(word.sub_category_id).sub_category}}</td>
                    <td>{{word.question_count}}</td>
                    <td>{{word.mistake_count}}</td>
                </tr> 
        </table>

    </div>

</template>
    <div>

    </div>


<script>
    export default {
        props: {
            words: {
                type: Array,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            sub_categories: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                is_visible_form: false,
                id: 0
            };
        },
        methods: {
            find_category: function (category_id){
                let result = this.categories.find((category) => category.id == category_id);
                return result;
            },
            find_sub_category: function (sub_category_id){
                let result = this.sub_categories.find((sub_category) => sub_category.id == sub_category_id);
                return result;                
            },
            To_edit_page: function (word_id){
                this.$router.push('edit/');
            },
            edit_href: function (id){
                
                let url = "location.href='/edit/" +id+"'";
                return url;
                
            },
            show_edit_form: function (id){
                if(this.id === 0){
                    this.id = id;
                }else{
                    this.id = 0;
                }
            }
            
        }
    }
</script>