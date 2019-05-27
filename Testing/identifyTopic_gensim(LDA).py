# Using Gensim

import re
import sys
if not sys.warnoptions:
    import warnings
    warnings.simplefilter("ignore")

from nltk.corpus import brown
from nltk import word_tokenize
from nltk.corpus import stopwords

from gensim import models, corpora
from gensim import similarities

########################################################################################

# get data from arguments

# data = sys.argv[1].split('.')
# doc_name = sys.argv[2]

# get input from text file

file = open("C:/xampp/htdocs/SpeechArt/sampleSpeech/Caffeine.txt","r")
InputData = file.read()
file.close()

#########################################################################################

# Set dataset

data = []
for fileid in brown.fileids():
    document = ' '.join(brown.words(fileid))
    data.append(document)

# Set Required number of Topics

numOfTopics = 10

# Text Cleaning

stopWords = stopwords.words('english')

def clean_text(text):
    tokenizedText = word_tokenize(text.lower())
    cleanedText = [t for t in tokenizedText if t not in stopWords and re.match('[a-zA-Z\-][a-zA-Z\-]{2,}', t)]
    return cleanedText


tokenizedData = []
for text in data:
    tokenizedData.append(clean_text(text))

dictionary = corpora.Dictionary(tokenizedData)
corpus = [dictionary.doc2bow(text) for text in tokenizedData]

# Build LDA model : Gensim

ldaModel = models.LdaModel(corpus=corpus, num_topics =numOfTopics, id2word=dictionary)

# Print most representative topics

for idx in range(numOfTopics):
    print("Topic #%s:" % idx, ldaModel.print_topic(idx, 10))

# Put models to work : LDA : Gensim

text = InputData
bow = dictionary.doc2bow(clean_text(text))

print(ldaModel[bow])

# Perform similarity queries : Identify Most Similar Documents from a dataset

ldaIndex = similarities.MatrixSimilarity(ldaModel[corpus])

similarities = ldaIndex[ldaModel[bow]]
similarities = sorted(enumerate(similarities), key=lambda item: -item[1])

print(similarities[:10])

documentId, similarity = similarities[0]
print(data[documentId][0:1000])
