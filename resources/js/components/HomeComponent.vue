<template>
    <div class="mt-1">
        <quiz-component :categories="categories" :sub_categories="sub_categories" :words="variable_words" @ask="countup_question_count"></quiz-component>
        <form-word-component :categories="categories" :sub_categories="sub_categories"></form-word-component>
        <form-category-component></form-category-component>
        <form-sub-category-component :categories="categories"></form-sub-category-component>
        <word-table-component :words="variable_words" :categories="categories" :sub_categories="sub_categories"></word-table-component>
    </div>
</template>

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
            variable_words: this.words
            // test: {id: 0, text:"よお"}
        };
    },
    methods: {
        countup_question_count: function(word_id) {
            axios.post("/quiz/ask",{
                word_id: word_id
            })
            .then(function (response) {

                this.variable_words = response.data.words;

            }.bind(this))
            .catch(function (error){

            })

        }
    }
}
</script>

<style scoped>

</style>