<template>
  <form>
    <div class="flex flex-col gap-4 px-8 py-2 rounded-md text-gray-700 select-none font-medium shadow bg-gray-200">
      <div class="flex gap-3 items-center" v-if="!showLanguages" @click="languageFields()">
        <font-awesome-icon v-if="!showLanguages" :icon="angleDownIcon" />
        <span>Pievienot valodas</span>  
      </div>
      <div class="flex gap-3 items-center" v-if="showLanguages" @click="hideLanguages()">
        <font-awesome-icon v-if="showLanguages" :icon="angleUpIcon" />
        <span>Slept valodas</span>  
      </div>      
      <div class="flex flex-col gap-4"
        v-if="showLanguages">
        <h3 class="text-3xl text-gray-700">Valodas</h3>
        <div class="flex flex-col gap-4" 
          v-for="(language, index) in languages" :key="index">
          <div class="flex flex-col">
            <label class="text-gray-700 select-none font-medium">Valoda</label>
            <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
              type="text" v-model="language.language" />
          </div>
          <div class="flex flex-col">
            <label class="text-gray-700 select-none font-medium">Līmenis</label>
            <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
              type="text" v-model="language.level" />
          </div>
          <div>
            <font-awesome-icon class="h-9 text-yellow-500" style="width: 40px !important;"
              :icon="saveIcon" 
              @click="editData(language)" 
              v-show="index == languages.length - 1"
              />
            <font-awesome-icon class="h-9 text-green-400" style="width: 40px !important;"
              :icon="addIcon"
              @click="addLanguage(index)"
              v-show="index == languages.length - 1"
              />
            <font-awesome-icon class="h-9 text-red-400" style="width: 28px !important;"
              :icon="removeIcon"
              @click="removeLanguage(index)"
              v-show="index || (!index && languages.length > 1)"
              />
          </div>  
        </div>
      </div>
    </div>
    <div v-if="errors.length" class="flex flex-col rounded p-8 shadow-md border-red-100 bg-red-50 text-red-800">
      <p>
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </p>
    </div>
  </form>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusSquare } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { faSave } from "@fortawesome/free-solid-svg-icons";
import { faAngleDown } from "@fortawesome/free-solid-svg-icons";
import { faAngleUp } from "@fortawesome/free-solid-svg-icons";

export default {
  props: ["userLanguage", "userBasicData"],
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      showLanguages: false,
      languages: [],
      removeIcon: faTrash,
      saveIcon: faSave,
      addIcon: faPlusSquare,
      angleDownIcon: faAngleDown,
      angleUpIcon: faAngleUp,
      errors: [],
    };
  },
  beforeMount() {
    this.setLanguageValues();
    if (this.languages.length > 0) {
      this.showLanguages = true;
    }
  },
  methods: {
    setLanguageValues() {
      for (let i = 0; i < this.userLanguage.length; i++) {
        this.languages.push({
          languageId: this.userLanguage[i].id,
          userId: this.userBasicData.user_Id,
          language: this.userLanguage[i].language,
          level: this.userLanguage[i].level,
        });
      }
    },
    checkForm() {
      this.errors = [];
      this.validateLanguage();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateLanguage() {
      const languageError = "Language required.";

      for (let i = 0; i < this.languages.length; i++) {
        if (
          !this.languages[i].language &&
          !this.errors.includes(languageError)
        ) {
          this.errors.push(languageError);
        }
      }
    },
    languageFields() {
      this.showLanguages = true;
      this.addLanguage();
    },
    hideLanguages() {
      this.showLanguages = false;
      this.languages = [];
    },
    addLanguage() {
      this.languages.push({
        languageId: 0,
        userId: this.userBasicData.user_Id,
        language: "",
        level: "",
      });
    },
    removeLanguage(index) {
      if (this.languages[index].languageId == 0) {
        this.languages.splice(index, 1);
      } else {
        this.deleteLanguage(this.languages[index].languageId);
      }
    },
    deleteLanguage(id) {
      axios
        .post("delete/language", {
          languageId: id,
        })
        .then((response) => {
          console.log("done");
        })
        .catch((error) => {
          console.log(error);
        });
      location.reload();
    },
    editData(languageField) {
      if (this.checkForm()) {
        axios
          .post("update/language", {
            language: languageField,
          })
          .then((response) => {
            console.log("done");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>