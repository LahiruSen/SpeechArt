import sys

if not sys.warnoptions:
    import warnings
    warnings.simplefilter("ignore")

from nltk.corpus import brown
import re
from gensim import models, corpora
from nltk import word_tokenize
from nltk.corpus import stopwords
# from gensim import similarities
from sklearn.decomposition import LatentDirichletAllocation
from sklearn.feature_extraction.text import CountVectorizer
import pyLDAvis.sklearn
from IPython.core.getipython import get_ipython
import sys

# get data from arguments

# data = sys.argv[1].split('.')
# doc_name = sys.argv[2]

# get input from text file

# file = open("C:/xampp/htdocs/SpeechArt/Caffeine.txt","r")
# data = file.read().splitlines()
# file.close()

# Get input form a dataset

# Prepare the dataset
# data = sys.argv[1]
data = []

for fileid in brown.fileids():
    document = ' '.join(brown.words(fileid))
    data.append(document)


# Text Cleaning

numOfTopics = 10
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



# Build LDA model

ldaModel = models.LdaModel(corpus=corpus, num_topics =numOfTopics, id2word=dictionary)


# Build the LSI model

# lsi_model = models.LsiModel(corpus=corpus, num_topics=numOfTopics, id2word=dictionary)

# for idx in range(numOfTopics):
#     # Print the first 10 most representative topics
#     print("Topic #%s:" % idx, ldaModel.print_topic(idx, 10))

# Put models to work

# text = "The economy is working better than ever"
# bow = dictionary.doc2bow(clean_text(text))

# print(ldaModel[bow])

# Perform similarity queries

# ldaIndex = similarities.MatrixSimilarity(ldaModel[corpus])

# similarities = ldaIndex[ldaModel[bow]]
# similarities = sorted(enumerate(similarities), key=lambda item: -item[1])

# print(similarities[:10])

# documentId, similarity = similarities[0]
# print(data[documentId][0:1000])

vectorizer = CountVectorizer(min_df=5, max_df=0.9, stop_words='english', lowercase=True, token_pattern='[a-zA-Z\-][a-zA-Z\-]{2,}')
dataVectorized = vectorizer.fit_transform(data)

ldaModel1 = LatentDirichletAllocation(n_components=numOfTopics, max_iter=10, learning_method='online')
ldaZ = ldaModel1.fit_transform(dataVectorized)

# x = ldaModel1.transform(vectorizer.transform([text]))[0]
# print(x, x.sum())


panel = pyLDAvis.sklearn.prepare(ldaModel1, dataVectorized, vectorizer, mds="tsne")

pyLDAvis.save_html(panel, "C:/xampp/htdocs/SpeechArt/LDA_visualizations/1.html")


