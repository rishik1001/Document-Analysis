import nltk
import sys
nltk.download('punkt')
nltk.download('averaged_perceptron_tagger')

document = sys.argv[1]
sentences = nltk.sent_tokenize(document)
words = [nltk.word_tokenize(sent) for sent in sentences]
result = ""
tagged_words = [nltk.pos_tag(w) for w in words]
for tagged_sentence in tagged_words:
    for tagged_word in tagged_sentence:
        if tagged_word[1] == 'NNP':
            result = result + tagged_word[0] + " "
sys.stdout.write(result)
