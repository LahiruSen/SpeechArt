# Using SKlearn

import sys
if not sys.warnoptions:
    import warnings
    warnings.simplefilter("ignore")

from sklearn.decomposition import LatentDirichletAllocation
from sklearn.feature_extraction.text import CountVectorizer
import pyLDAvis.sklearn


####################################################################################
# get data from arguments

data = sys.argv[1].split('.')
doc_name = sys.argv[2]

# get input from text file

# file = open("C:/xampp/htdocs/SpeechArt/sampleSpeech/Caffeine.txt","r")
# dataFull = file.read()
# data = dataFull.split('.')
# file.close()

####################################################################################

# Set Required number of Topics

numOfTopics = 10

vectorizer = CountVectorizer(min_df=5, max_df=0.9, stop_words='english', lowercase=True, token_pattern='[a-zA-Z\-][a-zA-Z\-]{2,}')
dataVectorized = vectorizer.fit_transform(data)

# Build LDA Model : Sklearn

ldaModel1 = LatentDirichletAllocation(n_components=numOfTopics, max_iter=10, learning_method='online')

# Visualize LDA Sklearn Results

panel = pyLDAvis.sklearn.prepare(ldaModel1, dataVectorized, vectorizer, mds="tsne")

pyLDAvis.save_html(panel, "C:/xampp/htdocs/SpeechArt/LDA_visualizations/"+doc_name+".html")


