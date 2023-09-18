<template>
    <div>

        <h3>大機能</h3>
        <div v-for="category in categories" :key="category['category']">
            <label>
                {{ category["category"] }}<input type="checkbox" name="category_checkbox" v-model="category['is_checked']">{{ category['is_checked'] }}
            </label>
        </div>

        <h3>中機能</h3>
        <div v-for="sub_category in sub_categories" :key="sub_category['sub_category']">
            <label>
                {{ sub_category["sub_category"] }}<input type="checkbox" name="category_checkbox" v-model="sub_category['is_checked']">
            </label>
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
            }
        },
        // data: function() {
            
        // }
    }

</script>