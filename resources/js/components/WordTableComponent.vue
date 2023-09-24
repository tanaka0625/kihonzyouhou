<template>
    <div>
        <table class="table table-bordered">

            <tr><th>id</th><th>単語</th><th>意味</th><th>大分類</th><th>中分類</th><th>出題回数</th><th>分からなかった回数</th></tr>
            <tr v-for="word in words" :key="word.id" :value="word.id">


                <td>
                    {{word.id}}
                    <button class="btn btn-primary" :onclick="edit_href(word.id)">編集</button>
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
                
            };
        },
        methods: {
            find_category: function (category_id){
                let result = this.categories.find((category) => category.id == category_id);
                console.log(result);
                return result;
            },
            find_sub_category: function (sub_category_id){
                let result = this.sub_categories.find((sub_category) => sub_category.id == sub_category_id);
                console.log(result);

                return result;                
            },
            To_edit_page: function (word_id){
                // window.location.href('edit/'.word_id);
                this.$router.push('edit/');
            },
            edit_href: function (id){
                
                let url = "location.href='/edit/" +id+"'";
                return url;
                
            }
            
        }
    }
</script>