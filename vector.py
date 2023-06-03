import pandas as pd
import pickle
from sklearn.feature_extraction.text import CountVectorizer

# Load the labeled text data into a Pandas DataFrame
data_path = input("Enter path of labeled text data: ")
df = pd.read_csv(data_path)

# Fit a CountVectorizer object to the text data
vectorizer = CountVectorizer(ngram_range=(1, 2))
vectorizer.fit(df['text'])

# Save the CountVectorizer object to a .pkl file
# vectorizer_path = input("Enter path to save CountVectorizer object: ")
with open('vectorizer.pkl', "wb") as f:
    pickle.dump(vectorizer, f)
