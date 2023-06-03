import pandas as pd
import numpy as np
import nltk
import string
import pickle
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.model_selection import train_test_split

# Load dataset
df = pd.read_csv('dataset.csv')

# Preprocess text data
stop_words = set(stopwords.words('english'))
def preprocess_text(text):
    text = text.translate(str.maketrans('', '', string.punctuation))
    text = text.lower()
    text = ' '.join([word for word in text.split() if word not in stop_words])
    return text
df['text'] = df['text'].apply(preprocess_text)

# Split dataset into training and test sets
X_train, X_test, y_train, y_test = train_test_split(df['text'], df['sentiment'], test_size=0.2, random_state=42)

# Extract features using n-gram model
ngram_vectorizer = CountVectorizer(ngram_range=(1, 2))
X_train_counts = ngram_vectorizer.fit_transform(X_train)

# Train classifier
clf = MultinomialNB()
clf.fit(X_train_counts, y_train)

# Evaluate performance on test set
X_test_counts = ngram_vectorizer.transform(X_test)
accuracy = clf.score(X_test_counts, y_test)
print("Accuracy:", accuracy)

# Save classifier to file
with open('sentiment_model.pkl', 'wb') as f:
    pickle.dump(clf, f)
